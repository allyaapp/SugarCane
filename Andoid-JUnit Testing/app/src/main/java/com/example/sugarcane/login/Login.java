package com.example.sugarcane.login;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

import com.example.sugarcane.R;
import com.example.sugarcane.register.Register;
import com.google.firebase.firestore.auth.User;
import com.google.gson.annotations.SerializedName;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class Login  {
    @SerializedName("data")
    private LoginData loginData;

    @SerializedName("message")
    private String message;

    @SerializedName("status")
    private boolean status;

    public void setLoginData(LoginData loginData){
        this.loginData = loginData;
    }

    public LoginData getLoginData(){
        return loginData;
    }

    public void setMessage(String message){
        this.message = message;
    }

    public String getMessage(){
        return message;
    }

    public void setStatus(boolean status){
        this.status = status;
    }

    public boolean isStatus(){
        return status;
    }
}