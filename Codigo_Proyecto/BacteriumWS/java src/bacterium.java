/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.ingenieria.ws;

import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;

/**
 *
 * @author Roberto
 */
@WebService(serviceName = "bacterium")
public class bacterium {

    /**
     * Web service operation
     */
    @WebMethod(operationName = "send_command")
    public String send_command(@WebParam(name = "message") String message) {
        //TODO write your implementation code here:
        //pass message to logic manager
        bacterium_logic bl = new bacterium_logic(message);
        return bl.getResponse();
    }
}
