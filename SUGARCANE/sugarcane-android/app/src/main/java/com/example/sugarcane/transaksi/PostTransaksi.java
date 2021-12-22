package com.example.sugarcane.transaksi;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class PostTransaksi {
    @SerializedName("user_id")
    private int user_id;

    @SerializedName("total_harga")
    private double total;

    @SerializedName("ongkir")
    private double ongkir;

    @SerializedName("items")
    private ArrayList<ItemTransaksi> items;

    public PostTransaksi(int user_id, double total, double ongkir, ArrayList<ItemTransaksi> items) {
        this.user_id = user_id;
        this.total = total;
        this.ongkir = ongkir;
        this.items = items;
    }
}
