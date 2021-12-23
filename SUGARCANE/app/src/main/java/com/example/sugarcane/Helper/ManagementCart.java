package com.example.sugarcane.Helper;

import android.content.Context;
import android.content.SharedPreferences;
import android.widget.Toast;

import com.example.cart.Cart;
import com.example.sugarcane.Domain.FoodDomain;
import com.example.sugarcane.Interface.ChangeNumberItemsListener;
import com.google.gson.Gson;

import java.util.ArrayList;

public class ManagementCart {
    private final Context context;

    public ManagementCart(Context context) {
        this.context = context;
    }

    public void minusNumberFood(ArrayList<Cart> listfood, int position, ChangeNumberItemsListener changeNumberItemsListener) {
        if (Integer.parseInt(listfood.get(position).getQty()) == 1) {
            listfood.remove(position);
        } else {
            listfood.get(position).setQty(String.valueOf(Integer.parseInt(listfood.get(position).getQty()) - 1));
        }
//        tinyDB.putListObject("CardList", listfood);
        SharedPreferences preferences = context.getSharedPreferences("cart", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();

        Gson gson = new Gson();
        String json = gson.toJson(listfood);
        editor.putString("cart", json);
        editor.apply();

        changeNumberItemsListener.changed();
    }

    public void plusNumberFood(ArrayList<Cart> listfood, int position, ChangeNumberItemsListener changeNumberItemsListener) {
        listfood.get(position).setQty(String.valueOf(Integer.parseInt(listfood.get(position).getQty()) + 1));
        SharedPreferences preferences = context.getSharedPreferences("cart", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();

        Gson gson = new Gson();
        String json = gson.toJson(listfood);
        editor.putString("cart", json);
        editor.apply();
        changeNumberItemsListener.changed();
    }

}

