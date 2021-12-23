package com.example.sugarcane.items;

import com.google.gson.annotations.SerializedName;

public class Items {

    @SerializedName("id_barang")
    private String id_barang;

    @SerializedName("varian")
    private String varian;

    @SerializedName("ukuran")
    private String ukuran;

    @SerializedName("id_detailukuran")
    private String id_detailukuran;

    @SerializedName("stok")
    private String stok;

    @SerializedName("gambar")
    private String gambar;

    @SerializedName("varianukuran")
    private String varianukuran;

    @SerializedName("harga")
    private String harga;

    @SerializedName("terjual")
    private String terjual;

    public String getId_barang() {
        return id_barang;
    }

    public void setId_barang(String id_barang) {
        this.id_barang = id_barang;
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

    public String getId_detailukuran() {
        return id_detailukuran;
    }

    public void setId_detailukuran(String id_detailukuran) {
        this.id_detailukuran = id_detailukuran;
    }

    public String getStok() {
        return stok;
    }

    public void setStok(String stok) {
        this.stok = stok;
    }

    public String getGambar() {
        return gambar;
    }

    public void setGambar(String gambar) {
        this.gambar = gambar;
    }

    public String getVarianukuran() {
        return varianukuran;
    }

    public void setVarianukuran(String varianukuran) {
        this.varianukuran = varianukuran;
    }

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = harga;
    }

    public String getTerjual() {
        return terjual;
    }

    public void setTerjual(String terjual) {
        this.terjual = terjual;
    }

}
