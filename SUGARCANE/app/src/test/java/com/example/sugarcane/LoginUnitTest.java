package com.example.sugarcane;

import android.content.Context;
import android.util.Log;

import com.example.api.ApiClient;
import com.example.api.ApiInterface;
import com.example.sugarcane.login.Login;

import org.junit.Assert;
import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.mockito.Mock;
import org.mockito.MockitoAnnotations;
import org.mockito.junit.MockitoJUnitRunner;


import java.util.concurrent.CountDownLatch;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

@RunWith(MockitoJUnitRunner.class)

public class LoginUnitTest {
    private static final String FAKE_STRING = "Login Berhasil";

    private String username = "dwiki";
    private String password = "dwiki";
    private Login login;
    private String message;
    private final CountDownLatch latch = new CountDownLatch(1);

    private ApiInterface apiInterface;

    @Before
    public void beforeTest() {
        MockitoAnnotations.initMocks(this);
        apiInterface = ApiClient.getClient().create(ApiInterface.class);
    }

    @Test
    public void test_login() throws InterruptedException {
//        Assert.assertNotNull(apiInterface);
        apiInterface.loginResponse(username, password).enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {
                login = response.body();
                message = login.getMessage();
                latch.countDown();
                System.out.println(message);
            }

            @Override
            public void onFailure(Call<Login> call, Throwable t) {
                Log.e("error", t.getMessage());
                latch.countDown();
            }
        });
        latch.await();
        Assert.assertNotNull(login);
        System.out.println(login.getMessage());
        assert message.equals(FAKE_STRING);
    }
}
