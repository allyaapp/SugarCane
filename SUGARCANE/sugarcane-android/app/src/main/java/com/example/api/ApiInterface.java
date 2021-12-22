package com.example.api;

import com.example.sugarcane.home.GetPopularItem;
import com.example.sugarcane.home.PopularItem;
import com.example.sugarcane.items.GetItems;
import com.example.sugarcane.listTransaksi.GetTransaksi;
import com.example.sugarcane.login.Login;
import com.example.sugarcane.ongkir.GetOngkir;
import com.example.sugarcane.profil.GetProfile;
import com.example.sugarcane.profil.UpdateProfile;
import com.example.sugarcane.register.Register;
import com.example.sugarcane.transaksi.KonfirmasiTransaksi;
import com.example.sugarcane.transaksi.PostTransaksi;
import com.example.sugarcane.transaksi.ResponseTransaksi;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

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
            @Field("username") String username,
            @Field("password") String password,
            @Field("fullname") String fullname,
            @Field("no_hp") String no_hp
    );

    @GET("list-popular-item.php")
    Call<GetPopularItem> getPopularItem();

    @GET("get-items.php")
    Call<GetItems> getItems(@Query("q") String q);

    @GET("get-profile.php")
    Call<GetProfile> getProfile(@Query("user_id") String user_id);

    @FormUrlEncoded
    @POST("update-profile.php")
    Call<UpdateProfile> updateProfile(
            @Field("user_id") String user_id,
            @Field("fullname") String fullname,
            @Field("alamat") String alamat,
            @Field("no_hp") String no_hp,
            @Field("username") String username,
            @Field("password") String password,
            @Field("foto") String foto,
            @Field("tmp_base") String base64,
            @Field("longitude") String longitude,
            @Field("latitude") String latitude);

    @GET("list-transaksi.php")
    Call<GetTransaksi> getTransaksi(@Query("user_id") String user_id);

    @GET("konfirmasi-pesanan.php")
    Call<KonfirmasiTransaksi> getKonfirmasi(@Query("id_transaksi") String id_transaksi);

    @GET("hitung-ongkir.php")
    Call<GetOngkir> getOngkir(@Query("user_id") String user_id);

    @POST("transaksi.php")
    Call<ResponseTransaksi> storeTransaksi(@Body PostTransaksi user_id);
}
