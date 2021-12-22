package com.example.sugarcane;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.login.Login;
import com.example.sugarcane.login.LoginData;
import com.example.sugarcane.register.Register;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity implements View.OnClickListener {
    EditText etUsername, etPassword;
    Button btnSignIn;
    String Username, Password;
    TextView tvRegister;
    ApiInterface apiInterface;
    SessionManager sessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etUsername = findViewById(R.id.usernamelogin);
        etPassword = findViewById(R.id.passwordlogin);

        btnSignIn = findViewById(R.id.btnLogin);
        btnSignIn.setOnClickListener(this);

        tvRegister = findViewById(R.id.tvRegister);
        tvRegister.setOnClickListener(this);

        apiInterface = ApiClient.getClient().create(ApiInterface.class);

    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btnLogin:
                Username = etUsername.getText().toString();
                Password = etPassword.getText().toString();
                login(Username, Password);
                break;
            case R.id.tvRegister:
                Intent intent = new Intent(this,RegisterActivity.class);
                startActivity(intent);
                finish();
                break;
        }
    }

    private void login(String username, String password) {
        Call<Login> loginCall = apiInterface.loginResponse(username, password);
        loginCall.enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {
                try {
                    if(response.body() != null && response.isSuccessful() && response.body().getError().equals(false)){

                        //untuk menyimpan sesi
                        sessionManager = new SessionManager(LoginActivity.this);
                        LoginData loginData = response.body().getLoginData();
                        sessionManager.createLoginSession(loginData);

                        //untuk pindah
                        Toast.makeText(LoginActivity.this, "Berhasil Login / Masuk", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                        startActivity(intent);
                    } else {
                        Toast.makeText(LoginActivity.this, "Gagal Login", Toast.LENGTH_SHORT).show();
                    }
                } catch (Exception e) {
                    Log.e("prosesLogin", e.getMessage());
                    Toast.makeText(LoginActivity.this, "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
                }


            }

            @Override
            public void onFailure(Call<Login> call, Throwable t) {
                Log.e("prosesLogin", t.getMessage());
                Toast.makeText(LoginActivity.this, "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
            }
        });


    }

}