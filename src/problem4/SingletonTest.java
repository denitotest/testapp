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
public class SingletonTest {
    public static void main(String[] args) {
        Singleton s1 = new Singleton();
        Singleton s2 = new Singleton();
        System.out.println(s1+ " \n" +s2);
            
    }
}
