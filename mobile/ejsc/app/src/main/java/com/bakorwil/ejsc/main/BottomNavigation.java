package com.bakorwil.ejsc.main;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;

import com.bakorwil.ejsc.R;
import com.bakorwil.ejsc.akun.LoginActivity;
import com.bakorwil.ejsc.botnav.akun.AkunFragment;
import com.bakorwil.ejsc.botnav.beranda.BerandaFragment;
import com.bakorwil.ejsc.botnav.booking.BookingFragment;
import com.bakorwil.ejsc.botnav.event.EventFragment;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;

public class BottomNavigation extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bottom_navigation);
        loadFragment(new BerandaFragment());
        BottomNavigationView navView = findViewById(R.id.bn_main);
        navView.setOnNavigationItemSelectedListener(this);
        // Passing each menu ID as a set of Ids because each
        // menu should be considered as top level destinations.
    }

    private boolean loadFragment(Fragment fragment) {
        if (fragment != null) {
            getSupportFragmentManager().beginTransaction()
                    .replace(R.id.fl_container, fragment)
                    .commit();
            return true;
        }
        return false;
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        Fragment fragment = null;

        switch (menuItem.getItemId()){
            case R.id.navigation_beranda:
                fragment = new BerandaFragment();
                break;
            case R.id.navigation_booking:
                fragment = new BookingFragment();
                break;
            case R.id.navigation_event:
                fragment = new EventFragment();
                break;
            case R.id.navigation_akun:
                fragment = new AkunFragment();
                break;
        }
        return loadFragment(fragment);
    }

    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setIcon(R.drawable.logo_ejsc)
                .setTitle("Keluar Aplikasi")
                .setMessage("Apakah Anda ingin keluar dari aplikasi?")
                .setPositiveButton("Ya", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        ActivityCompat.finishAffinity(BottomNavigation.this);
                        finish();
                    }
                })
                .setNegativeButton("Tidak", null)
                .show();
    }
}
