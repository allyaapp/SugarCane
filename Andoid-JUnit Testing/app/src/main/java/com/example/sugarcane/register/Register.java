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

    @SerializedName("message")
    private String message;

    @SerializedName("status")
    private boolean status;

    public void setRegisterData(RegisterData registerData){
        this.registerData = registerData;
    }

    public RegisterData getRegisterData(){
        return registerData;
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
