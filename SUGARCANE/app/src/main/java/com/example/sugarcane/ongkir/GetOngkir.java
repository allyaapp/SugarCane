package com.example.sugarcane.ongkir;

import com.google.gson.annotations.SerializedName;

public class GetOngkir {
    @SerializedName("error")
    private boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    @SerializedName("ongkir")
    private double ongkir;

    public boolean isError() {
        return error;
    }

    public GetOngkir setError(boolean error) {
        this.error = error;
        return this;
    }

    public String getError_msg() {
        return error_msg;
    }

    public GetOngkir setError_msg(String error_msg) {
        this.error_msg = error_msg;
        return this;
    }

    public double getOngkir() {
        return ongkir;
    }

    public GetOngkir setOngkir(double ongkir) {
        this.ongkir = ongkir;
        return this;
    }
}
