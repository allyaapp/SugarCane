package com.example.sugarcane.Adapter;

import static android.content.Context.LAYOUT_INFLATER_SERVICE;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.Activity.CartActivity;
import com.example.sugarcane.Activity.HomeActivity;
import com.example.sugarcane.Data;
import com.example.sugarcane.HistoryActivity;
import com.example.sugarcane.MainActivity;
import com.example.sugarcane.ProfileActivity;
import com.example.sugarcane.R;
import com.example.sugarcane.SessionManager;
import com.example.sugarcane.items.Items;
import com.example.sugarcane.listTransaksi.DataTransaksi;
import com.example.sugarcane.listTransaksi.Item;
import com.example.sugarcane.profil.UpdateProfile;
import com.example.sugarcane.transaksi.KonfirmasiTransaksi;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.HashMap;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HistoryAdapter extends RecyclerView.Adapter<HistoryAdapter.ViewHolder>{

    Context context;
    ArrayList<DataTransaksi> items;
    ApiInterface apiInterface;


    public HistoryAdapter(Context context, ArrayList<DataTransaksi> itemList) {
        this.context = context;
        this.items = itemList;
        this.apiInterface = ApiClient.getClient().create(ApiInterface.class);
    }

    @NonNull
    @Override
    public HistoryAdapter.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View inflate = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pesanan, parent, false);

        return new HistoryAdapter.ViewHolder(inflate);
    }


    @SuppressLint("SetTextI18n")
    @Override
    public void onBindViewHolder(@NonNull HistoryAdapter.ViewHolder holder,@SuppressLint("RecyclerView") int position) {
        holder.tvId.setText("ID :" +items.get(position).getId_transaksi());
        holder.tvTanggal.setText(items.get(position).getTgl_transaksi());
        holder.tvTotal.setText("Rp."+items.get(position).getTotal_harga());
        holder.tvStatus.setText(items.get(position).getStatus());

        if(items.get(position).getStatus().equals("diterima"))
            holder.btnKonfirmasi.setVisibility(View.GONE);
        else
            holder.btnKonfirmasi.setVisibility(View.VISIBLE);

        ArrayList<HashMap<String, String>> list = new ArrayList<>();

        int heightItem = 0;
        for (int i = 0; i < items.get(position).getData().size(); i++) {
            heightItem += 60;
            // creating an Object of HashMap class
            HashMap<String, String> map = new HashMap<>();

            // Data entry in HashMap
            map.put("varian", items.get(position).getData().get(i).getVarian()+""+items.get(position).getData().get(i).getUkuran());
            map.put("qty",items.get(position).getData().get(i).getQty());
            map.put("harga",items.get(position).getData().get(i).getHarga().replace(".00",""));

            // adding the HashMap to the ArrayList
            list.add(map);
        }
        heightItem += 26;
        String[] from = {"varian", "qty", "harga"};

        int[] to = {R.id.varian,R.id.qty,R.id.harga};

        SimpleAdapter simpleAdapter = new SimpleAdapter(context.getApplicationContext(),list,R.layout.row_product,from,to );

        ViewGroup.LayoutParams layoutParams = holder.listView.getLayoutParams();
        layoutParams.height = heightItem;

        holder.listView.setLayoutParams(layoutParams);
        holder.listView.setAdapter(simpleAdapter);
        String id_transaksi = items.get(position).getId_transaksi();

        holder.btnKonfirmasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                LayoutInflater inflater = (LayoutInflater)
                        context.getSystemService(LAYOUT_INFLATER_SERVICE);
                View popupView = inflater.inflate(R.layout.pop_up, null);

                // create the popup window
                int width = LinearLayout.LayoutParams.WRAP_CONTENT;
                int height = LinearLayout.LayoutParams.WRAP_CONTENT;
                boolean focusable = true; // lets taps outside the popup also dismiss it
                final PopupWindow popupWindow = new PopupWindow(popupView, width, height, focusable);

                // show the popup window
                // which view you pass in doesn't matter, it is only used for the window tolken
                popupWindow.showAtLocation(view, Gravity.CENTER, 0, 0);

                Button btnKonfir = popupView.findViewById(R.id.konfir);
                Button btnTidak = popupView.findViewById(R.id.tidak);
                btnKonfir.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        Call<KonfirmasiTransaksi> call = apiInterface.getKonfirmasi(id_transaksi);
                        call.enqueue(new Callback<KonfirmasiTransaksi>() {
                            @Override
                            public void onResponse(Call<KonfirmasiTransaksi> call, Response<KonfirmasiTransaksi> response) {
                                try {
                                    if(response.body() != null && response.isSuccessful() && !response.body().getError()){
                                        popupWindow.dismiss();
                                        holder.tvStatus.setText("diterima");
                                        holder.btnKonfirmasi.setVisibility(View.GONE);
                                        Toast.makeText(context.getApplicationContext(), "Berhasil Konfirmasi Pesanan", Toast.LENGTH_SHORT).show();
                                    } else {
                                        Toast.makeText(context.getApplicationContext(), "Gagal ", Toast.LENGTH_SHORT).show();
                                    }

                                }catch (Exception e){
                                    Toast.makeText(context.getApplicationContext(), "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
                                }
                            }

                            @Override
                            public void onFailure(Call<KonfirmasiTransaksi> call, Throwable t) {
                                Toast.makeText(context.getApplicationContext(), " Kesalahan", Toast.LENGTH_SHORT).show();
                            }
                        });
                    }
                });

                btnTidak.setOnClickListener(new View.OnClickListener(){
                    @Override
                    public void onClick(View view) {
                        popupWindow.dismiss();
                    }
                });

            }
        });
    }

    @Override
    public int getItemCount() {
        return this.items.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView tvId, tvTanggal, tvTotal,tvStatus;
        ListView listView;
        Button btnKonfirmasi;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            tvId = itemView.findViewById(R.id.id_pesanan);
            tvTanggal = itemView.findViewById(R.id.tanggal);
            tvTotal = itemView.findViewById(R.id.total);
            listView = itemView.findViewById(R.id.history);
            tvStatus = itemView.findViewById(R.id.status);
            btnKonfirmasi = itemView.findViewById(R.id.btn_konfirmasi);

        }
    }
}
