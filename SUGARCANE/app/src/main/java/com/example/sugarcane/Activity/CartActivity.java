package com.example.sugarcane.Activity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.ScrollView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.cart.Cart;
import com.example.sugarcane.Adapter.CartListAdapter;
import com.example.sugarcane.Helper.ManagementCart;
import com.example.sugarcane.HistoryActivity;
import com.example.sugarcane.Interface.ChangeNumberItemsListener;
import com.example.sugarcane.LoginActivity;
import com.example.sugarcane.MainActivity;
import com.example.sugarcane.ProfileActivity;
import com.example.sugarcane.R;
import com.example.sugarcane.SessionManager;
import com.example.sugarcane.ongkir.GetOngkir;
import com.example.sugarcane.transaksi.ItemTransaksi;
import com.example.sugarcane.transaksi.PostTransaksi;
import com.example.sugarcane.transaksi.ResponseTransaksi;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.lang.reflect.Type;
import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CartActivity extends AppCompatActivity {
    private RecyclerView.Adapter adapter;
    private RecyclerView recyclerViewList;
    private ManagementCart managementCart;
    private ConstraintLayout btnPesan;
    private TextView totalFeeTxt, taxTxt, deliveryTxt, totalTxt, emptyTxt;
    private double tax;
    private ScrollView scrollView;
    private ArrayList<Cart> cartList;
    private LinearLayout detailLayout;
    private ProgressBar progressBar;
    private ApiInterface apiInterface;
    private SessionManager sessionManager;
    private String userId;
    private double ongkir = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);

        apiInterface = ApiClient.getClient().create(ApiInterface.class);
        sessionManager = new SessionManager(CartActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }

        userId = sessionManager.getUserDetail().get(SessionManager.USER_ID);

        initView();
        initList();
        hitungOngkir();

        btnPesan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                prosesPesan();
            }
        });
    }

    private void prosesPesan() {
        SharedPreferences pref = getSharedPreferences("cart", MODE_PRIVATE);
        SharedPreferences.Editor editor = pref.edit();

        ArrayList<ItemTransaksi> items = new ArrayList<>();
        double subtotal = 0;
        for (int i=0;i<cartList.size();i++) {
            int id_barang = Integer.parseInt(cartList.get(i).getId_barang());
            int qty = Integer.parseInt(cartList.get(i).getQty());
            double subharga = qty * Double.parseDouble(cartList.get(i).getHarga());
            subtotal += subharga;

            items.add(new ItemTransaksi(id_barang, qty, subharga));
        }
        int user_id = Integer.parseInt(sessionManager.getUserDetail().get(SessionManager.USER_ID));

        PostTransaksi request = new PostTransaksi(user_id, subtotal, this.ongkir, items);

        apiInterface.storeTransaksi(request).enqueue(new Callback<ResponseTransaksi>() {
            @Override
            public void onResponse(Call<ResponseTransaksi> call, Response<ResponseTransaksi> response) {
                try {
                    if (response.body() != null && response.isSuccessful() && !response.body().isError()) {
                        editor.clear();
                        editor.commit();

                        Toast.makeText(CartActivity.this, "Berhasil melakukan pesanan", Toast.LENGTH_SHORT).show();
                    }
                    else {
                        Toast.makeText(CartActivity.this, "Gagal melakukan pesanan", Toast.LENGTH_SHORT).show();
                    }
                }
                catch (Exception e) {
                    Toast.makeText(CartActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseTransaksi> call, Throwable t) {
                Toast.makeText(CartActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
        this.finish();
    }

    private void moveToLogin() {
        sessionManager.logoutSession();
        Intent intent = new Intent(CartActivity.this, LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();
    }

    private void initList() {
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false);
        recyclerViewList.setLayoutManager(linearLayoutManager);
        cartList = loadCart();

        adapter = new CartListAdapter(cartList, this, new ChangeNumberItemsListener() {
            @Override
            public void changed() {
                calculateCard(ongkir);
            }
        });

        recyclerViewList.setAdapter(adapter);
        if (cartList.isEmpty()) {
            emptyTxt.setVisibility(View.VISIBLE);
            scrollView.setVisibility(View.GONE);
        } else {
            emptyTxt.setVisibility(View.GONE);
            scrollView.setVisibility(View.VISIBLE);
        }
    }

    private ArrayList<Cart> loadCart() {
        SharedPreferences preferences = getSharedPreferences("cart", MODE_PRIVATE);

        Gson gson = new Gson();
        String json = preferences.getString("cart", null);
        Type type = new TypeToken<ArrayList<Cart>>() {}.getType();
        cartList = gson.fromJson(json, type);

        if (cartList == null) {
            cartList = new ArrayList<>();
        }

        return cartList;
    }

    private void hitungOngkir() {
        apiInterface.getOngkir(userId).enqueue(new Callback<GetOngkir>() {
            @Override
            public void onResponse(Call<GetOngkir> call, Response<GetOngkir> response) {
                try {
                    if(response.body() != null && response.isSuccessful() && !response.body().isError()) {
                        ongkir = response.body().getOngkir();
                        calculateCard(ongkir);
                    }
                    else {
                        Toast.makeText(CartActivity.this, "Harap tentukan pick point terlebih dahulu", Toast.LENGTH_SHORT).show();
                    }
                }
                catch (Exception e) {
                    Toast.makeText(CartActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<GetOngkir> call, Throwable t) {
                Toast.makeText(CartActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void calculateCard(double ongkir) {
        cartList = loadCart();
        double percentTax = 0.02;  //you can change this item for tax price
        double delivery = ongkir;     //you can change this item you need price for delivery
        double subtotal = 0;

        for (int i=0;i<cartList.size();i++) {
            String qty = cartList.get(i).getQty();
            String harga = cartList.get(i).getHarga();
            subtotal += Double.parseDouble(qty) * Double.parseDouble(harga);
        }

        tax = 1000;
        double total = Math.round((subtotal + tax + delivery) * 100.0) / 100.0;
        double itemTotal = Math.round(subtotal * 100.0) / 100.0;

        totalFeeTxt.setText("Rp." + itemTotal);
        taxTxt.setText("Rp." + tax);
        deliveryTxt.setText("Rp." + delivery);
        totalTxt.setText("Rp." + total);

        progressBar.setVisibility(View.GONE);
        detailLayout.setVisibility(View.VISIBLE);
        if(cartList.size() == 0)
            detailLayout.setVisibility(View.GONE);
    }

    private void initView() {
        btnPesan = findViewById(R.id.btn_pesan);
        totalFeeTxt = findViewById(R.id.totalFeeTxt);
        taxTxt = findViewById(R.id.taxTxt);
        deliveryTxt = findViewById(R.id.deliveryTxt);
        totalTxt = findViewById(R.id.totalTxt);
        recyclerViewList = findViewById(R.id.rv_pesanan);
        scrollView = findViewById(R.id.scrollView);
        emptyTxt = findViewById(R.id.emptyTxt);
        detailLayout = findViewById(R.id.detail_layout);
        progressBar = findViewById(R.id.progress_circular);

        detailLayout.setVisibility(View.GONE);
    }

    @Override
    public void onBackPressed() {
        Intent explicit_intent = new Intent(CartActivity.this, MainActivity.class);
        startActivity(explicit_intent);
        finish();
    }
}
