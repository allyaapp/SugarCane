package com.example.sugarcane.listTransaksi;

import com.example.sugarcane.login.LoginData;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class GetTransaksi {
    @SerializedName("data")
    private ArrayList<DataTransaksi> dataTransaksi;

    @SerializedName("error")
    private Boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    public ArrayList<DataTransaksi> getDataTransaksi() {
        return dataTransaksi;
    }


    public void setDataTransaksi(ArrayList<DataTransaksi> dataTransaksi) {
        this.dataTransaksi = dataTransaksi;
    }

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
