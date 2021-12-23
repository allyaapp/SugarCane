package com.example.sugarcane;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.Activity.CartActivity;
import com.example.sugarcane.Adapter.ItemsAdapter;
import com.example.sugarcane.items.GetItems;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ItemsActivity extends AppCompatActivity {

    ApiInterface apiInterface;
    EditText editSearch;
    ImageButton btnSearch;
    RecyclerView rvItems;
    Intent requestData;
    SessionManager sessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_items);

        sessionManager = new SessionManager(ItemsActivity.this);
        if(!sessionManager.isLoggedIn()){
            moveToLogin();
        }
        apiInterface = ApiClient.getClient().create(ApiInterface.class);

        requestData = getIntent();

        editSearch = findViewById(R.id.editSearch);
        btnSearch = findViewById(R.id.btn_search);
        rvItems = findViewById(R.id.rv_item);
        rvItems.setLayoutManager(new LinearLayoutManager(ItemsActivity.this));

        String q = requestData != null || (requestData.getStringExtra("q") != null ||
                !requestData.getStringExtra("q").equals("")) ? requestData.getStringExtra("q") : "";

        editSearch.setText(q);

        retrieveItems(q);

        btnSearch.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                retrieveItems(editSearch.getText().toString());
            }
        });
    }

    private void moveToLogin() {
        sessionManager.logoutSession();
        Intent intent = new Intent(ItemsActivity.this,LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();
    }

    private void retrieveItems(String q) {
        q = q != null ? q : "";
        apiInterface.getItems(q).enqueue(new Callback<GetItems>() {
            @Override
            public void onResponse(Call<GetItems> call, Response<GetItems> response) {
                try {
                    if(response.body() != null && response.isSuccessful() && !response.body().isError()) {
                        ItemsAdapter adapter = new ItemsAdapter(ItemsActivity.this, response.body().getItems());

                        rvItems.setAdapter(adapter);
                    }
                }
                catch (Exception e) {
                    Toast.makeText(ItemsActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<GetItems> call, Throwable t) {
                Toast.makeText(ItemsActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public void onBackPressed() {
        Intent explicit_intent = new Intent(ItemsActivity.this, MainActivity.class);
        startActivity(explicit_intent);
        finish();
    }
}