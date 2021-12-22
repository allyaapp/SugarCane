package com.example.sugarcane;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.Uri;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.provider.MediaStore;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.profil.GetProfile;
import com.example.sugarcane.profil.UpdateProfile;
import com.google.android.material.textfield.TextInputEditText;

import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfileActivity extends AppCompatActivity implements LocationListener {

    ApiInterface apiInterface;
    SessionManager sessionManager;
    SharedPreferences sharedPreferences;

    LocationManager locationManager;
    Button btn_pickpoint;
    ImageView imgView;
    TextView tvFullname, tvUsername, tvJumlah;
    TextInputEditText edtUsername, edtPassword, edtFullname, edtNo_hp, edtAlamat;

    String tvLongitude, tvLatitude, id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        sessionManager = new SessionManager(ProfileActivity.this);

        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);

        initView();

        apiInterface = ApiClient.getClient().create(ApiInterface.class);

        getProfileUser();

        btn_pickpoint = findViewById(R.id.pickpoint);
        if (ContextCompat.checkSelfPermission(ProfileActivity.this, Manifest.permission.ACCESS_FINE_LOCATION)
                != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(ProfileActivity.this, new String[]{
                    Manifest.permission.ACCESS_FINE_LOCATION
            }, 100);
        }

        btn_pickpoint.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getLocation();
            }
        });
    }

    @SuppressLint("MissingPermission")
    private void getLocation() {
        try {
            locationManager = (LocationManager) getApplicationContext().getSystemService(LOCATION_SERVICE);
            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 5000, 5, ProfileActivity.this);
        } catch (Exception e) {
            e.printStackTrace();
        }

    }

    public void actionSimpan(View view) {
        formCheck();
    }

    private void getProfileUser() {
        id = sessionManager.getUserDetail().get(SessionManager.USER_ID);
        Call<GetProfile> getProfilUser = apiInterface.getProfile(id);
        getProfilUser.enqueue(new Callback<GetProfile>() {
            @Override
            public void onResponse(Call<GetProfile> call, Response<GetProfile> response) {
                try {
                    tvUsername.setText(response.body().getProfileData().username);
                    tvFullname.setText(response.body().getProfileData().fullname);
                    tvJumlah.setText(response.body().getJumlah_pesanan());

                    edtFullname.setText(response.body().getProfileData().fullname);
                    edtPassword.setText(response.body().getProfileData().password);
                    edtUsername.setText(response.body().getProfileData().username);
                    edtAlamat.setText(response.body().getProfileData().alamat);
                    edtNo_hp.setText(response.body().getProfileData().no_hp);

                } catch (Exception e){
                    Log.e("getProfilUser", e.getMessage());
                    Toast.makeText(ProfileActivity.this, "Terjadi kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<GetProfile> call, Throwable t) {
                Toast.makeText(ProfileActivity.this, "Server tidak terjangkau", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void initView() {
        tvFullname = findViewById(R.id.fullname);
        tvUsername = findViewById(R.id.username);
        tvJumlah = findViewById(R.id.count_pesanan);

        imgView = findViewById(R.id.img_profile);

        edtUsername = findViewById(R.id.edt_username);
        edtPassword = findViewById(R.id.edt_password);
        edtFullname = findViewById(R.id.edt_fullname);
        edtAlamat = findViewById(R.id.edt_alamat);
        edtNo_hp = findViewById(R.id.edt_nohp);

//        edt_longitude = findViewById(R.id.edt_longitude);
//        edt_latitude = findViewById(R.id.edt_latitude);
    }

    private void formCheck() {
        final String username = edtUsername.getText().toString();
        final String password = edtPassword.getText().toString();
        final String fullname = edtFullname.getText().toString();
        final String alamat = edtAlamat.getText().toString();
        final String no_hp = edtNo_hp.getText().toString();

        if (TextUtils.isEmpty(username)) {
            edtUsername.setError("Please enter username");
            edtUsername.requestFocus();
            return;
        }

        //checking if email is empty
        if (TextUtils.isEmpty(password)) {
            edtPassword.setError("Please enter password");
            edtPassword.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(alamat)) {
            edtAlamat.setError("Please Klik Button Pick Point");
            edtAlamat.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(fullname)) {
            edtFullname.setError("Please enter your name");
            edtFullname.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(no_hp)) {
            edtNo_hp.setError("Please enter your phone number");
            edtNo_hp.requestFocus();
            return;
        }

        if ((tvLongitude==null || tvLatitude==null) || (tvLongitude.equals(String.valueOf(0)) || tvLatitude.equals(String.valueOf(0)))) {
            try {
                Toast.makeText(ProfileActivity.this, "Please Klik Button Pick Point", Toast.LENGTH_SHORT).show();
                return;
            } catch (Exception e) {
                Toast.makeText(ProfileActivity.this, "Please Klik Button Pick Point", Toast.LENGTH_SHORT).show();
                return;
            }

        }

        update(id, fullname, alamat, no_hp, username, password,  "", "", tvLongitude, tvLatitude);
    }

    private void update(String user_id, String fullname, String alamat, String no_hp, String username, String password, String foto, String tmp_name, String longitude, String latitude) {
        Call<UpdateProfile> call = apiInterface.updateProfile(user_id, fullname, alamat, no_hp, username, password, null, null, longitude,latitude);
        call.enqueue(new Callback<UpdateProfile>() {
            @Override
            public void onResponse(Call<UpdateProfile> call, Response<UpdateProfile> response) {
                try {
                    if(response.body() != null && response.isSuccessful() && !response.body().getError()){
                        SharedPreferences.Editor editor = sharedPreferences.edit();
                        editor.putString(SessionManager.NAME, fullname);
                        editor.putString(SessionManager.USERNAME, username);
                        editor.putString(SessionManager.LONGITUDE, longitude);
                        editor.putString(SessionManager.LATITUDE, latitude);
                        editor.commit();
                        Toast.makeText(ProfileActivity.this, "Berhasil Mengubah Data", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(ProfileActivity.this, ProfileActivity.class);
                        startActivity(intent);
                        finish();

                    } else {
                        Toast.makeText(ProfileActivity.this, "Gagal Mengubah Data", Toast.LENGTH_SHORT).show();
                    }
                }
                catch (Exception e) {
                    Log.e("prosesUpdate", e.getMessage());
                    Toast.makeText(ProfileActivity.this, "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<UpdateProfile> call, Throwable t) {
                Log.e("prosesUpdate", t.getMessage());
                Toast.makeText(ProfileActivity.this, "Terjadi Kesalahan", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public void onLocationChanged(@NonNull Location location) {
        tvLatitude = String.valueOf(location.getLatitude());
        tvLongitude = String.valueOf(location.getLongitude());
        try {
            Geocoder geocoder = new Geocoder(ProfileActivity.this, Locale.getDefault());
            List<Address> addresses = geocoder.getFromLocation(location.getLatitude(), location.getLongitude(), 1);
            String address = addresses.get(0).getAddressLine(0);

            edtAlamat.setText(address);
            Toast.makeText(ProfileActivity.this, "Berhasil mengambil pick point", Toast.LENGTH_SHORT).show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(@NonNull String provider) {

    }

    @Override
    public void onProviderDisabled(@NonNull String provider) {

    }

    public void tambahFoto(View view) {
        Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        startActivityForResult(intent, 3);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == RESULT_OK && data != null) {
            Uri selectedImage = data.getData();
            ImageView imageView = findViewById(R.id.img_profile);
            imageView.setImageURI(selectedImage);
        }
    }
}