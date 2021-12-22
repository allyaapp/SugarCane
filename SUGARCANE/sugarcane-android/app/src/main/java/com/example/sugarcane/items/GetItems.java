package com.example.sugarcane.items;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class GetItems {
    @SerializedName("error")
    private boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    @SerializedName("data")
    private ArrayList<Items> items;

    public boolean isError() {
        return error;
    }

    public void setError(boolean error) {
        this.error = error;
    }

    public String getError_msg() {
        return error_msg;
    }

    public void setError_msg(String error_msg) {
        this.error_msg = error_msg;
    }

    public ArrayList<Items> getItems() {
        return items;
    }

    public void setItems(ArrayList<Items> items) {
        this.items = items;
    }
}
