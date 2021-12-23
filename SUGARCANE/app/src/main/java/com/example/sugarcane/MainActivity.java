package com.example.sugarcane;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.Activity.CartActivity;
import com.example.sugarcane.Adapter.PopularItemAdapter;
import com.example.sugarcane.home.GetPopularItem;
import com.example.sugarcane.items.GetItems;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity{
    ImageButton btnProfil, btnLogout;
    ImageView btnRiwayat;
    LinearLayout btnHome;
    TextView etUsername, tvGoItems;
    EditText editSearch;
    ImageButton btnSearch;
    LinearLayout btnCart;
    SessionManager sessionManager;
    String username;
    ApiInterface apiInterface;
    RecyclerView rv_popular;

    @SuppressLint("ClickableViewAccessibility")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.home);

        sessionManager = new SessionManager(MainActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }
        apiInterface = ApiClient.getClient().create(ApiInterface.class);

        btnLogout = findViewById(R.id.btn_logout);
        btnProfil = findViewById(R.id.btn_prof);
        btnHome = findViewById(R.id.homeBtn);
        btnRiwayat = findViewById(R.id.btn_riwayat);
        btnCart = findViewById(R.id.cartBtn);
        etUsername = findViewById(R.id.MainUsername);
        username = sessionManager.getUserDetail().get(SessionManager.USERNAME);
        tvGoItems = findViewById(R.id.textView12);
        editSearch = findViewById(R.id.editSearch);
        btnSearch = findViewById(R.id.btn_search);
        rv_popular = findViewById(R.id.view2);

        etUsername.setText(username);

        retrievePopularItem();

        tvGoItems.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, ItemsActivity.class));
            }
        });

        btnSearch.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent goItemsActivity = new Intent(MainActivity.this, ItemsActivity.class);
                goItemsActivity.putExtra("q", editSearch.getText().toString());
                startActivity(goItemsActivity);
            }
        });

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(MainActivity.this, MainActivity.class));
                finish();
            }
        });

        btnCart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, CartActivity.class));
            }
        });

        btnProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(MainActivity.this, ProfileActivity.class));
            }
        });

        btnRiwayat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(MainActivity.this, HistoryActivity.class));
            }
        });

        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                moveToLogin();
            }
        });
    }

    @Override
    protected void onResume() {
        super.onResume();
        username = sessionManager.getUserDetail().get(SessionManager.USERNAME);
        etUsername.setText(username);
    }

    private void retrievePopularItem() {
        apiInterface.getPopularItem().enqueue(new Callback<GetPopularItem>() {
            @Override
            public void onResponse(Call<GetPopularItem> call, Response<GetPopularItem> response) {
                try {
                    if(response.body() != null && response.isSuccessful() && !response.body().isError()) {
                        PopularItemAdapter adapter = new PopularItemAdapter(MainActivity.this, response.body().getPopularItems());
                        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(MainActivity.this);
                        linearLayoutManager.setOrientation(LinearLayoutManager.HORIZONTAL);
                        rv_popular.setLayoutManager(linearLayoutManager);
                        rv_popular.setAdapter(adapter);
                    }
                }
                catch (Exception e) {
                    Toast.makeText(MainActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<GetPopularItem> call, Throwable t) {
                Toast.makeText(MainActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void moveToLogin() {
        sessionManager.logoutSession();
        Intent intent = new Intent(MainActivity.this,LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();
    }
}

