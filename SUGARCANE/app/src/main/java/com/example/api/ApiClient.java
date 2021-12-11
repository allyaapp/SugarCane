package com.example.api;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ApiClient {
<<<<<<< HEAD
    private static final String BASE_URL = "http://192.168.56.1/sugarcane/";
=======
    private static final String BASE_URL = "http://192.168.250.227/sugarcane/";
>>>>>>> 22f4ba4e4c42cdcbf0a6ba34903cc72faaa1991e

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
