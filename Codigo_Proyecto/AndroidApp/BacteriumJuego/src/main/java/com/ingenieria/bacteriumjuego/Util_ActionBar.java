package com.ingenieria.bacteriumjuego;

import android.content.Context;
import android.util.AttributeSet;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.TextView;

/**
 * Created by Roberto on 15/06/13.
 */
public class Util_ActionBar extends LinearLayout implements View.OnClickListener {

    private View mView;
    private ImageButton imbHome;
    private TextView tvTitle;
    private ProgressBar pbLoading;
    private OnActionBarClickListener mClickListener;

    public Util_ActionBar(Context context, AttributeSet attrs) {
        super(context, attrs);
        //get utils_actionbar.xml as view
        mView = LayoutInflater.from(context).inflate(R.layout.util_actionbar, this);
        imbHome = (ImageButton) mView.findViewById(R.id.ab_Home);
        tvTitle = (TextView) mView.findViewById(R.id.ab_Title);
        pbLoading = (ProgressBar) mView.findViewById(R.id.ab_Process);
        imbHome.setOnClickListener(this);
    }

    //set icon to home button
    public void setHomeIcon(int imageId) {
        imbHome.setImageResource(imageId);
    }

    //set home button Clickable and Focusable
    public void EnableButtonHome() {
        imbHome.setClickable(true);
        imbHome.setFocusable(true);
    }

    //home button not Clickable and not Focusable only shows icon
    public void DisableButtonHome() {
        imbHome.setClickable(false);
        imbHome.setFocusable(false);
    }

    //show progress bar in action bar while process is loading
    public void startProgress() {
        pbLoading.setVisibility(View.VISIBLE);
    }

    //hide progress bar in action bar when process is loaded
    public void stopProgress() {
        pbLoading.setVisibility(View.GONE);
    }

    //set title in action bar
    public void setTitle(String strTitle) {
        tvTitle.setText(strTitle);
    }

    //create interface for click listener in differents views
    public interface OnActionBarClickListener {
        public void OnActionBarCick(int id);
    }

    //get id from pressed iu element
    @Override
    public void onClick(View v) {
        mClickListener.OnActionBarCick(v.getId());
    }

    //click listener for action bar
    public void setOnABClickListener(OnActionBarClickListener v) {
        mClickListener = v;
    }

}