package com.example.sugarcane;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.Adapter.HistoryAdapter;
import com.example.sugarcane.listTransaksi.GetTransaksi;
import com.example.sugarcane.transaksi.KonfirmasiTransaksi;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HistoryActivity extends AppCompatActivity {

    ApiInterface apiInterface;
    SessionManager sessionManager;
    RecyclerView rvItems;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_history);
        rvItems = findViewById(R.id.rv_pesanan);
        rvItems.setLayoutManager(new LinearLayoutManager(getApplicationContext()));
        sessionManager = new SessionManager(HistoryActivity.this);

        apiInterface = ApiClient.getClient().create(ApiInterface.class);

        getTransaksi();
    }

    private void getTransaksi() {
        apiInterface.getTransaksi(String.valueOf(sessionManager.getUserDetail().get(SessionManager.USER_ID))).enqueue(new Callback<GetTransaksi>() {
            @Override
            public void onResponse(Call<GetTransaksi> call, Response<GetTransaksi> response) {
                try {
                    if (response.body() != null && response.isSuccessful() && !response.body().getError()) {
                        HistoryAdapter adapter = new HistoryAdapter(getApplicationContext(), response.body().getDataTransaksi());

                        rvItems.setAdapter(adapter);
                    }
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<GetTransaksi> call, Throwable t) {
                Toast.makeText(getApplicationContext(), "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
    }



}