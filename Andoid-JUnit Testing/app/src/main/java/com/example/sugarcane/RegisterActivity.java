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
import com.example.sugarcane.register.Register;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RegisterActivity extends AppCompatActivity implements View.OnClickListener {
    EditText editTextUsername, editFullname, editPhone, editTextPassword, editConfirmPassword;
    Button btnRegister;
    TextView tvLogin;
    String Username, Fullname, Phone, Password, ConfirmPassword;
    ApiInterface apiInterface;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.register);

        editTextUsername = findViewById(R.id.usernameRegister);
        editTextPassword = findViewById(R.id.passwordRegister);
        editFullname= findViewById(R.id.fullname);
        editPhone= findViewById(R.id.phone);
        editConfirmPassword= findViewById(R.id.confrimPassword);
        btnRegister = findViewById(R.id.btnSignUp);
        btnRegister.setOnClickListener(this);

        tvLogin = findViewById(R.id.tvLogin);
        tvLogin.setOnClickListener(this);

    }

    @Override
    public void onClick(View view) {
        switch (view.getId()){
            case R.id.btnSignUp:
                Username = editTextUsername.getText().toString();
                Password = editTextPassword.getText().toString();
                Fullname = editFullname.getText().toString();
                Phone = editPhone.getText().toString();
                ConfirmPassword = editConfirmPassword.getText().toString();
                register(Username, Password, Fullname, Phone, ConfirmPassword);
                break;
            case R.id.tvLogin:
                Intent intent = new Intent(this, MainActivity.class);
                startActivity(intent);
                finish();
                break;
        }
    }

    private void register(String username, String password, String fullname, String phone, String ConfirmPassword) {

        apiInterface = ApiClient.getClient().create(ApiInterface.class);
        Call<Register> call = apiInterface.registerResponse(username, password, fullname, phone, ConfirmPassword);
        call.enqueue(new Callback<Register>() {
            @Override
            public void onResponse(Call<Register> call, Response<Register> response) {
                if(response.body() != null && response.isSuccessful() && response.body().isStatus()){
                    Toast.makeText(RegisterActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(RegisterActivity.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                } else {
                    Toast.makeText(RegisterActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Register> call, Throwable t) {
                Toast.makeText(RegisterActivity.this, t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });


    }
}
