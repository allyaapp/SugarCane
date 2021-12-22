package com.example.sugarcane.Adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.example.api.ApiClient;
import com.example.sugarcane.Activity.ShowDetailActivity;
import com.example.sugarcane.R;
import com.example.sugarcane.items.Items;

import java.util.ArrayList;

public class ItemsAdapter extends RecyclerView.Adapter<ItemsAdapter.ItemsViewHolder> {

    Context context;
    ArrayList<Items> itemList;

    public ItemsAdapter(Context context, ArrayList<Items> itemList) {
        this.context = context;
        this.itemList = itemList;
    }

    @NonNull
    @Override
    public ItemsViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View inflate = LayoutInflater.from(parent.getContext()).inflate(R.layout.viewholder_item, parent, false);

        return new ItemsAdapter.ItemsViewHolder(inflate);
    }

    @Override
    public int getItemCount() {
        return this.itemList.size();
    }

    @SuppressLint("SetTextI18n")
    @Override
    public void onBindViewHolder(@NonNull ItemsViewHolder holder, @SuppressLint("RecyclerView") int position) {
        holder.tvTitle.setText(itemList.get(position).getVarian()+" "+itemList.get(position).getUkuran());
        holder.tvVarianUkuran.setText(itemList.get(position).getVarianukuran());
        holder.tvStok.setText("Stok : "+itemList.get(position).getStok());
        holder.tvHarga.setText("Rp."+itemList.get(position).getHarga());

        String urlImg = ApiClient.DOMAIN_URL+"images/product/"+itemList.get(position).getGambar();

        Glide.with(holder.itemView.getContext())
                .load(urlImg)
                .into(holder.img);

        holder.btnShowDetail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent goDetail = new Intent(context, ShowDetailActivity.class);
                goDetail.putExtra("id_barang", itemList.get(position).getId_barang());
                goDetail.putExtra("img_url", urlImg);
                goDetail.putExtra("varian", itemList.get(position).getVarian());
                goDetail.putExtra("stok", itemList.get(position).getStok());
                goDetail.putExtra("ukuran", itemList.get(position).getUkuran());
                goDetail.putExtra("varianukuran", itemList.get(position).getVarianukuran());
                goDetail.putExtra("harga", itemList.get(position).getHarga());

                context.startActivity(goDetail);
            }
        });

    }

    public class ItemsViewHolder extends RecyclerView.ViewHolder {
        ImageView img;
        Button btnShowDetail;
        TextView tvTitle, tvVarianUkuran, tvStok, tvHarga;

        public ItemsViewHolder(@NonNull View itemView) {
            super(itemView);
            img = itemView.findViewById(R.id.pic);
            tvTitle = itemView.findViewById(R.id.titleTxt);
            tvVarianUkuran = itemView.findViewById(R.id.tv_varian_ukuran);
            tvStok = itemView.findViewById(R.id.tv_stok);
            tvHarga = itemView.findViewById(R.id.tv_harga);
            btnShowDetail = itemView.findViewById(R.id.btn_show_detail);
        }
    }
}
