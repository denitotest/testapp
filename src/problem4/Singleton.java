/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package problem4;

/**
 *
 * @author Bobi
 */
public class Singleton {

    private static Singleton instance;

    static {
        instance= new Singleton();
    }

    protected Singleton() {

    }

    public static Singleton getInstance() {
        return instance;
    }

}
