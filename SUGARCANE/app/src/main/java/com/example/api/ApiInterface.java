package com.example.api;

import com.example.sugarcane.login.Login;
import com.example.sugarcane.register.Register;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ApiInterface {
    @FormUrlEncoded
    @POST("login.php")
    Call<Login> loginResponse(
            @Field("username") String username,
            @Field("password") String password
    );

    @FormUrlEncoded
    @POST("register.php")
    Call<Register> registerResponse(
            String username, @Field("email") String email,
            @Field("password") String password,
            @Field("name") String name,
            String kelas);
}
