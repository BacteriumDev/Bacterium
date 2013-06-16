/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.ingenieria.ws;

/**
 *
 * @author Roberto
 */
public class bacterium_logic {
    
    private String message;
    private String response = "no response";
    
    public bacterium_logic(String msg)
    {
        this.message = msg;
        this.processMessage();
    }
    
    private void processMessage()
    {
        //Identify tag operation
        char opid = this.message.charAt(0);
        if(opid == 'A')
        {
            this.loginuser();
        }
    }
    
    private void loginuser()
    {
        String[] sm = message.split("\\|\\|");
        String username = sm[1];
        String password = sm[2];
        customJDBC cjdbc = new customJDBC();
        boolean exist = cjdbc.existsRegistry("SELECT * FROM usuarios WHERE alias='"+username+"' AND password='"+password+"'");
        if(exist)
        {
            response = "Aprobado";
        }else
        {
            response = "Rechazado";
        }
    }
    
   
    public String getResponse()
    {
        return response;
    }
    
}
