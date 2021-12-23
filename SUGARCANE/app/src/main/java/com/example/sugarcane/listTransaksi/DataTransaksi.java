package com.example.sugarcane.listTransaksi;

import com.example.sugarcane.Data;
import com.example.sugarcane.home.PopularItem;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;
import java.util.Date;

public class DataTransaksi {
    @SerializedName("id_transaksi")
    public String id_transaksi;
    @SerializedName("id_user")
    public String id_user;
    @SerializedName("tgltransaksi")
    public String tgl_transaksi;
    @SerializedName("ongkir")
    public String ongkir;
    @SerializedName("totalharga")
    public String total_harga;
    @SerializedName("status")
    public String status;
    @SerializedName("item")
    private ArrayList<Item> data;

    public DataTransaksi(String id_transaksi, String id_user, String tgl_transaksi, String ongkir, String total_harga, String status){
        this.id_transaksi = id_transaksi;
        this.id_user = id_user;
        this.tgl_transaksi = tgl_transaksi;
        this.ongkir = ongkir;
        this.total_harga = total_harga;
        this.status= status;
    }


    public String getId_transaksi() {
        return id_transaksi;
    }

    public void setId_transaksi(String id_transaksi) {
        this.id_transaksi = id_transaksi;
    }

    public String getId_user() {
        return id_user;
    }

    public void setId_user(String id_user) {
        this.id_user = id_user;
    }

    public String getTgl_transaksi() {
        return tgl_transaksi;
    }
    public void setTgl_transaksi(String tgl_transaksi) {
        this.tgl_transaksi = tgl_transaksi;
    }

    public String getOngkir() {
        return ongkir;
    }

    public void setOngkir(String ongkir) {
        this.ongkir = ongkir;
    }


    public String getTotal_harga() {
        return total_harga;
    }

    public void setTotal_harga(String total_harga) {
        this.total_harga = total_harga;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public ArrayList<Item> getData() {
        return data;
    }

    public void setData(ArrayList<Item> data) {
        this.data = data;
    }
}
