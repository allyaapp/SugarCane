package com.example.sugarcane.register;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.example.sugarcane.R;
import com.example.sugarcane.login.Login;
import com.google.gson.annotations.SerializedName;

public class Register  {
    @SerializedName("data")
    private RegisterData registerData;

    @SerializedName("error")
    private Boolean error;

    @SerializedName("error_msg")
    private String error_msg;

    public RegisterData getRegisterData() {
        return registerData;
    }

    public void setRegisterData(RegisterData registerData) {
        this.registerData = registerData;
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
