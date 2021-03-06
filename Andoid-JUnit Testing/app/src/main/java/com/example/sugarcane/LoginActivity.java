package com.example.sugarcane;

import android.content.Intent;
import android.os.Bundle;
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

    String message;

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
                break;
        }
    }

    private void login(String username, String password) {
        apiInterface = ApiClient.getClient().create(ApiInterface.class);
        Call<Login> loginCall = apiInterface.loginResponse(username, password);
        loginCall.enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {
                if(response.body() != null && response.isSuccessful() && response.body().isStatus()){

                    //untuk menyimpan sesi
                    sessionManager = new SessionManager(LoginActivity.this);
                    LoginData loginData = response.body().getLoginData();
                    sessionManager.createLoginSession(loginData);

                    //untuk pindah
                    Toast.makeText(LoginActivity.this, response.body().getLoginData().getName(), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                    message = "Login was succesfull";
                } else {
                    Toast.makeText(LoginActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    message = "Invalid Login";
                }

            }

            @Override
            public void onFailure(Call<Login> call, Throwable t) {
                Toast.makeText(LoginActivity.this, t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
                message = "Invalid Login";
            }
        });


    }
}