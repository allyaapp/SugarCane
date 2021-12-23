package com.example.api;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ApiClient {

    public static final String DOMAIN_URL = "http://192.168.56.1/sugarcane/";
    public static final String BASE_URL = DOMAIN_URL+"api/";
    private static Retrofit retrofit;

    public static Retrofit getClient() {
        if(retrofit == null){
            Gson gson = new GsonBuilder()
                    .setLenient()
                    .create();
            retrofit = new Retrofit.Builder()
                    .baseUrl(BASE_URL)
                    .addConverterFactory(GsonConverterFactory.create(gson))
                    .build();
        }

        return retrofit;
    }
}
