package com.example.sugarcane.listTransaksi;

import com.google.gson.annotations.SerializedName;



public class Item {
    @SerializedName("varian")
    public String varian;
    @SerializedName("ukuran")
    public String ukuran;
    @SerializedName("qty")
    public String qty;
    @SerializedName("subharga")
    public String  harga;


    public Item ( String varian, String ukuran, String qty, String harga){
        this.varian = varian;
        this.ukuran = ukuran;
        this.qty = qty;
        this.harga = harga;
    }

    public String getVarian() {
        return varian;
    }

    public void setVarian(String varian) {
        this.varian = varian;
    }

    public String getUkuran() {
        return ukuran;
    }

    public void setUkuran(String ukuran) {
        this.ukuran = ukuran;
    }

    public String getQty() {
        return qty;
    }

    public void setQty(String qty) {
        this.qty = qty;
    }

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = harga;
    }
}
