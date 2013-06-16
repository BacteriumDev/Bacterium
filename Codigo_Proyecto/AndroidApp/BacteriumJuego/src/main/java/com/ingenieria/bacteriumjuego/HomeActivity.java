package com.ingenieria.bacteriumjuego;

import android.app.TabActivity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.graphics.Color;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.Menu;
import android.view.Window;
import android.widget.LinearLayout.LayoutParams;
import android.widget.TabHost;
import android.widget.TabHost.OnTabChangeListener;
import android.widget.TextView;

public class HomeActivity extends TabActivity {

    Util_ActionBar actionbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
        setContentView(R.layout.activity_home);

        try{
            actionbar = (Util_ActionBar) findViewById(R.id.utilactionbar);
            actionbar.setTitle("Hub - Bacterium");
            actionbar.DisableButtonHome();
            setTabStyle();
        }catch(Exception w)
        {
            Log.d("Error", w.getMessage());
        }


    }

    private void setTabStyle() {
        TabHost tabs = (TabHost) findViewById(android.R.id.tabhost);
        tabs.setup();
        // add login tab
        TabHost.TabSpec spec = tabs.newTabSpec("Cuenta");
        Intent itCuenta = new Intent(this, JugadorActivity.class);
        spec.setContent(itCuenta);
        spec.setIndicator(makeTabIndicator("Cuenta"));
        tabs.addTab(spec);

        // add register tab
        spec = tabs.newTabSpec("Partidas");
        Intent itPartidas = new Intent(this, PartidasActivity.class);
        spec.setContent(itPartidas);
        spec.setIndicator(makeTabIndicator("Partidas"));
        tabs.addTab(spec);

        spec = tabs.newTabSpec("Torneos");
        Intent itTorneos = new Intent(this, TorneosActivity.class);
        spec.setContent(itTorneos);
        spec.setIndicator(makeTabIndicator("Torneos"));
        tabs.addTab(spec);

        tabs.setCurrentTab(0);

        tabs.setOnTabChangedListener(new OnTabChangeListener() {
            @Override
            public void onTabChanged(String tabId) {
                actionbar.setTitle(tabId + " - Bacterium");
            }
        });
    }

    private TextView makeTabIndicator(String text) {
        // make style for tabs
        TextView tabView = new TextView(this);
        LayoutParams params = new LayoutParams(LayoutParams.WRAP_CONTENT, 50, 1);
        params.setMargins(1, 0, 1, 0);
        tabView.setLayoutParams(params);
        tabView.setText(text);
        tabView.setTextColor(Color.BLACK);
        tabView.setGravity(Gravity.CENTER_HORIZONTAL | Gravity.CENTER_VERTICAL);
        tabView.setBackgroundDrawable(getResources().getDrawable(R.drawable.style_tab_layout));
        tabView.setPadding(13, 0, 13, 0);
        return tabView;
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.home, menu);
        return true;
    }
    
}
