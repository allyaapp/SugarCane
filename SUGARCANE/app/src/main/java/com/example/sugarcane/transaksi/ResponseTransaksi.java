package com.example.sugarcane.transaksi;

import com.google.gson.annotations.SerializedName;

public class ResponseTransaksi {
    @SerializedName("error")
    private boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    public boolean isError() {
        return error;
    }

    public ResponseTransaksi setError(boolean error) {
        this.error = error;
        return this;
    }

    public String getError_msg() {
        return error_msg;
    }

    public ResponseTransaksi setError_msg(String error_msg) {
        this.error_msg = error_msg;
        return this;
    }
}
