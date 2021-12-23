package com.example.sugarcane;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.util.Patterns;
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

public class RegisterActivity extends AppCompatActivity {
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
        tvLogin = findViewById(R.id.tvLogin);

        apiInterface = ApiClient.getClient().create(ApiInterface.class);

        tvLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                startActivity(intent);
            }
        });

        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                formCheck();
            }
        });

    }

    private void formCheck() {
        final String username = editTextUsername.getText().toString();
        final String password = editTextPassword.getText().toString();
        final String confPass = editConfirmPassword.getText().toString();
        final String fullname = editFullname.getText().toString();
        final String no_hp = editPhone.getText().toString();

        if (TextUtils.isEmpty(username)) {
            editTextUsername.setError("Please enter username");
            editTextUsername.requestFocus();
            return;
        }

        //checking if email is empty
        if (TextUtils.isEmpty(password)) {
            editTextPassword.setError("Please enter password");
            editTextPassword.requestFocus();
            return;
        }
        //checking if password is empty
        if (TextUtils.isEmpty(confPass)) {
            editConfirmPassword.setError("Please enter password");
            editConfirmPassword.requestFocus();
            return;
        }
        //validating email

        if (!confPass.equals(password)) {
            editConfirmPassword.setError("Password Does not Match");
            editConfirmPassword.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(fullname)) {
            editFullname.setError("Please enter your name");
            editFullname.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(no_hp)) {
            editPhone.setError("Please enter your phone number");
            editPhone.requestFocus();
            return;
        }

        register(username, password, fullname, no_hp);
    }

    private void register(String username, String password, String fullname, String no_hp) {
        Call<Register> call = apiInterface.registerResponse(username, password, fullname, no_hp);
        call.enqueue(new Callback<Register>() {
            @Override
            public void onResponse(Call<Register> call, Response<Register> response) {
                try {
                    if(response.body() != null && response.isSuccessful() && !response.body().getError()){
                        Toast.makeText(RegisterActivity.this, "Berhasil mendaftar", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(RegisterActivity.this, MainActivity.class);
                        startActivity(intent);
                        finish();
                    } else {
                        Toast.makeText(RegisterActivity.this, "Gagal mendaftarkan akun", Toast.LENGTH_SHORT).show();
                    }
                }
                catch (Exception e) {
                    Log.e("prosesRegister", e.getMessage());
                    Toast.makeText(RegisterActivity.this, "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Register> call, Throwable t) {
                Log.e("prosesRegister", t.getMessage());
                Toast.makeText(RegisterActivity.this, "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
    }

}
