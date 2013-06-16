package com.ingenieria.bacteriumjuego;

import android.util.Log;

import org.ksoap2.SoapEnvelope;
import org.ksoap2.serialization.PropertyInfo;
import org.ksoap2.serialization.SoapObject;
import org.ksoap2.serialization.SoapPrimitive;
import org.ksoap2.serialization.SoapSerializationEnvelope;
import org.ksoap2.transport.HttpTransportSE;

/**
 * Created by Roberto on 15/06/13.
 */
public class WebServiceConnector {
    private final String NAMESPACE = "http://ws.ingenieria.com/";
    private final String URL = "http://163.178.93.101:8080/BacteriumWS/bacterium?wsdl";
    //private final String URL = "http://localhost:8080/BacteriumWS/bacterium?wsdl";
    private final String SOAP_ACTION = "http://ws.ingenieria.com/bacterium";
    private final String METHOD_NAME = "send_command";

    private String wsresponse;

    public String getResponse(String wsmessage)
    {
        try{
            this.requestWebServiceConnection(wsmessage);
        }catch(Exception w)
        {
            Log.d("Error", w.getMessage());
        }
        return wsresponse;
    }

    private void requestWebServiceConnection(String message) {
        SoapObject request = new SoapObject(NAMESPACE, METHOD_NAME);

        PropertyInfo fnameProp =new PropertyInfo();
        fnameProp.setName("message");
        fnameProp.setValue(message);
        fnameProp.setType(String.class);
        request.addProperty(fnameProp);

        SoapSerializationEnvelope envelope = new SoapSerializationEnvelope(SoapEnvelope.VER11);
        envelope.setOutputSoapObject(request);
        HttpTransportSE androidHttpTransport = new HttpTransportSE(URL);

        try {
            androidHttpTransport.call(SOAP_ACTION, envelope);
            SoapPrimitive response = (SoapPrimitive)envelope.getResponse();


            wsresponse = response.toString();

        } catch (Exception e) {
            Log.d("Error", e.getMessage());
        }

    }


}