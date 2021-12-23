package com.example.sugarcane.transaksi;

import com.example.sugarcane.listTransaksi.DataTransaksi;
import com.example.sugarcane.profil.ProfileData;
import com.google.gson.annotations.SerializedName;

public class KonfirmasiTransaksi {

    @SerializedName("error")
    private Boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    public Boolean getError() {
        return error;
    }

    public void setError(Boolean error) {
        this.error = error;
    }

    public String getError_msg() {
        return error_msg;
    }

    public void setError_msg(String error_msg) {
        this.error_msg = error_msg;
    }
}
