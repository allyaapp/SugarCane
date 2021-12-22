package com.example.sugarcane;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;

import com.example.sugarcane.login.LoginData;

import java.util.HashMap;

public class SessionManager {
    private final Context _context;
    private final SharedPreferences sharedPreferences;
    private final SharedPreferences.Editor editor;

    public static final String IS_LOGGED_IN = "isLoggedIn";
    public static final String USER_ID = "id_user";
    public static final String USERNAME = "username";
    public static final String NAME = "fullname";
    public static final String LONGITUDE = "longitude";
    public static final String LATITUDE = "latitude";

    public SessionManager(Context context){
        this._context = context;
        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(context);
        editor = sharedPreferences.edit();
    }

    public void createLoginSession(LoginData user){
        editor.putBoolean(IS_LOGGED_IN, true);
        editor.putInt(USER_ID, user.getId_user());
        editor.putString(USERNAME, user.getUsername());
        editor.putString(NAME, user.getFullname());
        editor.putString(LONGITUDE, user.getLongitude());
        editor.putString(LATITUDE, user.getLatitude());
        editor.commit();
    }

    public HashMap<String,String> getUserDetail(){
        HashMap<String,String> user = new HashMap<>();
        user.put(USER_ID, String.valueOf(sharedPreferences.getInt(USER_ID, 0)));
        user.put(USERNAME, sharedPreferences.getString(USERNAME,null));
        user.put(NAME, sharedPreferences.getString(NAME,null));
        user.put(LONGITUDE, sharedPreferences.getString(LONGITUDE, null));
        user.put(LATITUDE, sharedPreferences.getString(LATITUDE, null));
        return user;
    }

    public void logoutSession(){
        editor.clear();
        editor.commit();
    }

    public boolean isLoggedIn(){
        return sharedPreferences.getBoolean(IS_LOGGED_IN, false);
    }
}
