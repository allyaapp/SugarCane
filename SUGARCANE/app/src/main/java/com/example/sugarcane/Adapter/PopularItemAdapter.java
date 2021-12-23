package com.example.sugarcane.Adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.example.api.ApiClient;
import com.example.sugarcane.Activity.ShowDetailActivity;
import com.example.sugarcane.R;
import com.example.sugarcane.home.PopularItem;

import java.util.ArrayList;

public class PopularItemAdapter extends RecyclerView.Adapter<PopularItemAdapter.PopularViewHolder> {

    Context context;
    ArrayList<PopularItem> popularItems;

    public PopularItemAdapter(Context context, ArrayList<PopularItem> popularItems) {
        this.context = context;
        this.popularItems = popularItems;
    }

    @NonNull
    @Override
    public PopularViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View inflate = LayoutInflater.from(parent.getContext()).inflate(R.layout.viewholder_recommended, parent, false);

        return new PopularItemAdapter.PopularViewHolder(inflate);
    }

    @Override
    public int getItemCount() {
        return this.popularItems.size();
    }

    @Override
    public void onBindViewHolder(@NonNull PopularViewHolder holder, @SuppressLint("RecyclerView") int position) {
        holder.tvTitle.setText(popularItems.get(position).getVarian());
        holder.tvHarga.setText(popularItems.get(position).getHarga());

        String urlImg = ApiClient.DOMAIN_URL+"images/product/"+popularItems.get(position).getGambar();

        Glide.with(holder.itemView.getContext())
                .load(urlImg)
                .into(holder.img);

//        holder.btnAdd.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Toast.makeText(context, popularItems.get(position).getId_barang(), Toast.LENGTH_SHORT).show();
//            }
//        });

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent goDetail = new Intent(context, ShowDetailActivity.class);
                goDetail.putExtra("id_barang", popularItems.get(position).getId_barang());
                goDetail.putExtra("img_url", urlImg);
                goDetail.putExtra("varian", popularItems.get(position).getVarian());
                goDetail.putExtra("stok", popularItems.get(position).getStok());
                goDetail.putExtra("ukuran", popularItems.get(position).getId_detailukuran());
                goDetail.putExtra("varianukuran", popularItems.get(position).getVarianukuran());
                goDetail.putExtra("harga", popularItems.get(position).getHarga());

                context.startActivity(goDetail);
            }
        });

    }

    public class PopularViewHolder extends RecyclerView.ViewHolder {

        ImageView img;
        TextView tvTitle, tvHarga;

        public PopularViewHolder(@NonNull View itemView) {
            super(itemView);
            img = itemView.findViewById(R.id.pic);
            tvTitle = itemView.findViewById(R.id.title);
            tvHarga = itemView.findViewById(R.id.fee);
        }
    }
}
