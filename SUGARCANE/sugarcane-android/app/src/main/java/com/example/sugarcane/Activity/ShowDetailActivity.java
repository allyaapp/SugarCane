package com.example.sugarcane.Activity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.cart.Cart;
import com.example.sugarcane.Domain.FoodDomain;
import com.example.sugarcane.Helper.ManagementCart;

import com.bumptech.glide.Glide;
import com.example.sugarcane.R;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.lang.reflect.Type;
import java.util.ArrayList;

public class ShowDetailActivity extends AppCompatActivity {
    private TextView addToCartBtn;
    private TextView titleTxt, feeTxt, numberOrderTxt, totalPriceTxt, tvStok, tvVarianUkuran;
    private ImageView plusBtn, minusBtn, picFood;
    private FoodDomain object;
    private int numberOrder = 1;
    private ManagementCart managementCart;
    private Intent data;
    private ArrayList<Cart> cartList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show_detail);

        data = getIntent();

        managementCart = new ManagementCart(this);

        iniView();
        getBundle();
    }

    private void getBundle() {
        object = (FoodDomain) getIntent().getSerializableExtra("object");
        String id_barang = data.getStringExtra("id_barang");
        String img_url = data.getStringExtra("img_url");
        String varian = data.getStringExtra("varian");
        String stok = data.getStringExtra("stok");
        String ukuran = data.getStringExtra("ukuran");
        String varianukuran = data.getStringExtra("varianukuran");
        String harga = data.getStringExtra("harga");
        
        Glide.with(this)
                .load(img_url)
                .into(picFood);

        titleTxt.setText(varian + " " + ukuran);
        feeTxt.setText("Rp." + harga);
        // descriptionTxt.setText(object.getDescription());
        numberOrderTxt.setText(String.valueOf(numberOrder));
        tvStok.setText(stok);
        tvVarianUkuran.setText(varianukuran);
        totalPriceTxt.setText("Rp."+Math.round(numberOrder * Integer.parseInt(harga)));

        plusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                numberOrder = numberOrder + 1;
                numberOrderTxt.setText(String.valueOf(numberOrder));
                totalPriceTxt.setText("Rp."+Math.round(numberOrder * Integer.parseInt(harga)));
            }
        });

        minusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (numberOrder > 1) {
                    numberOrder = numberOrder - 1;
                }
                numberOrderTxt.setText(String.valueOf(numberOrder));
                totalPriceTxt.setText("Rp."+Math.round(numberOrder * Integer.parseInt(harga)));
            }
        });

        addToCartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                addToCart(id_barang, img_url, varian, String.valueOf(numberOrder), harga, String.valueOf((numberOrder * Integer.parseInt(harga))));
            }
        });
    }

    private void addToCart(String id_barang, String imgUrl, String varian, String qty, String harga, String total) {
        SharedPreferences preferences = getSharedPreferences("cart", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        cartList = new ArrayList<>();
        cartList = loadCart();

        // Mengecek apakah item sudah ada di cart
        int currentIndex = -1;
        for(int i=0;i<this.cartList.size();i++){
            if(Integer.parseInt(this.cartList.get(i).getId_barang()) == Integer.parseInt(id_barang)){
                currentIndex = i;
            }
        }

        if(currentIndex >= 0) {
            // Item sudah ada dan akan di update
            cartList.get(currentIndex).setQty(qty);
            cartList.get(currentIndex).setTotal(total);
        }
        else {
            // Tambah item baru
            cartList.add(new Cart(id_barang, imgUrl, varian, qty, harga, total));
        }

        Gson gson = new Gson();
        String json = gson.toJson(cartList);
        editor.putString("cart", json);
        editor.apply();

        Toast.makeText(ShowDetailActivity.this, "Item berhasil ditambahkan", Toast.LENGTH_SHORT).show();
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

    private void iniView() {
        addToCartBtn = findViewById(R.id.addToCartBtn);
        titleTxt = findViewById(R.id.titleTxt);
        feeTxt = findViewById(R.id.priceTxt);
        numberOrderTxt = findViewById(R.id.numberItemTxt);
        plusBtn = findViewById(R.id.plusCardBtn);
        minusBtn = findViewById(R.id.minusCardBtn);
        picFood = findViewById(R.id.foodPic);
        totalPriceTxt = findViewById(R.id.totalPriceTxt);
        tvStok = findViewById(R.id.tv_stok);
        tvVarianUkuran = findViewById(R.id.tv_varian_ukuran);
    }
}