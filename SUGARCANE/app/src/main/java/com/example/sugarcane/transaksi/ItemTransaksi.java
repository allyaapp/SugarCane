package com.example.sugarcane.transaksi;

import com.google.gson.annotations.SerializedName;

public class ItemTransaksi {
    @SerializedName("id_barang")
    private final int id_barang;

    @SerializedName("qty")
    private final int qty;

    @SerializedName("subharga")
    private final double subharga;

    public ItemTransaksi(int id_barang, int qty, double subharga) {
        this.id_barang = id_barang;
        this.qty = qty;
        this.subharga = subharga;
    }
}
