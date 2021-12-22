package com.example.sugarcane.home;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

public class GetPopularItem {
    @SerializedName("error")
    private boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    @SerializedName("data")
    private ArrayList<PopularItem> popularItems;

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

    public ArrayList<PopularItem> getPopularItems() {
        return popularItems;
    }

    public void setPopularItems(ArrayList<PopularItem> popularItems) {
        this.popularItems = popularItems;
    }
}
