package com.example.api;

import android.content.Context;
import android.content.SharedPreferences;


public class sharedpref {
    private final String ID_USER = "id_user";
    private final String FULLNAME = "fullname";
    private final String ALAMAT = "password";
    private final String USERNAME = "username";
    private final String NOHP = "no_hp";
    private final String PASSWORD = "password";

    private final String INTRO = "intro";
    private SharedPreferences sPref;
    private Context context;


    public sharedpref(Context context){
        sPref = context.getSharedPreferences("sugarcane", Context.MODE_PRIVATE);
        this.context = context;
    }

    public void putIsLoggin(boolean isloggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putBoolean(INTRO, isloggedin);
        edit.commit();
    }

    public boolean getIsLoggin(){
        return sPref.getBoolean(INTRO, false);
    }

    public void setId(String isLoggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putString(ID_USER, isLoggedin);
        edit.commit();
    }

    public void setUsername(String isLoggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putString(USERNAME, isLoggedin);
        edit.commit();
    }

    public void setPass(String isLoggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putString(PASSWORD, isLoggedin);
        edit.commit();
    }

    public void setName(String isLoggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putString(FULLNAME, isLoggedin);
        edit.commit();
    }

    public void setNohp(String isLoggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putString(NOHP, isLoggedin);
        edit.commit();
    }

    public void setAlamat(String isLoggedin){
        SharedPreferences.Editor edit = sPref.edit();
        edit.putString(ALAMAT, isLoggedin);
        edit.commit();
    }

    public String getID(){
        return sPref.getString(ID_USER, "");
    }

    public String getUsername(){
        return sPref.getString(USERNAME, "");
    }

    public String getPassword(){
        return sPref.getString(PASSWORD, "");
    }

    public String getName(){
        return sPref.getString(FULLNAME, "");
    }

    public String getNohp(){
        return sPref.getString(NOHP, "");
    }

    public String getAlamat(){
        return sPref.getString(ALAMAT, "");
    }

}
