/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cliente;

import java.awt.Dimension;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JButton;
import javax.swing.JFrame;
import static javax.swing.JFrame.EXIT_ON_CLOSE;
import javax.swing.JLabel;
import javax.swing.JTextArea;
import javax.swing.JTextField;
 
public class Cliente extends JFrame{
    
    private String portn, ipn, text;
    private JTextField texport, mensaje, texip;
    private JTextArea historial;
    private JButton start, finish, send;
    private JLabel port, message, ip;
    
    public Cliente(){
        super();//se declara como superclase
        start=new JButton("Iniciar");
        start.setLocation(450,30);
        start.setSize(100,30);
        finish=new JButton("Detener");
        finish.setLocation(600,30);
        finish.setSize(100,30);
        finish.setEnabled(false);
        send=new JButton("Enviar");
        send.setLocation(650,300);
        send.setSize(100,30);
        send.setEnabled(false);
        texip=new JTextField();
        texip.setLocation(130,30);
        texip.setSize(100,30);
        texport=new JTextField();
        texport.setLocation(300,30);
        texport.setSize(100,30);
        historial=new JTextArea();
        historial.setLocation(100,70);
        historial.setSize(600,200);
        historial.setEnabled(false);
        mensaje=new JTextField();
        mensaje.setLocation(200,300);
        mensaje.setSize(400,30);
        port=new JLabel("puerto:");
        port.setLocation(240,30);
        port.setSize(100,30);
        message=new JLabel("mansaje:");
        message.setLocation(100,300);
        message.setSize(100,30);
        ip=new JLabel("Ip:");
        ip.setLocation(100,30);
        ip.setSize(70,30);
        
        setLayout(null);
        
        
        
        add(start);
        add(finish);
        add(send);
        add(texip);
        add(texport);
        add(mensaje);
        add(historial);
        add(port);
        add(message);
        add(ip);
        setSize(800, 400);//se define el tamaño de pantalla
        Toolkit tk;
        tk=Toolkit.getDefaultToolkit ();
        Dimension tamPant=tk.getScreenSize();
        setLocation((tamPant.width-getSize().width)/2,(tamPant.height-getSize().height)/2);
        setTitle("Comunicacion Servidor");//se define el nombre de la ventana
        setDefaultCloseOperation(EXIT_ON_CLOSE);//se define lo cuando se ciierre la vantana se termine el proceso
        setResizable(false);//no permite que el usuario modifique el tamaño de la ventana
        setVisible(true);//para que sea visible (siempre va al final
    }
 
    public static void main(String[] args) {
 
        
        //puerto del servidor
        final int PUERTO_SERVIDOR = 5000;
        //buffer donde se almacenara los mensajes
        byte[] buffer = new byte[1024];
 
        try {
            //Obtengo la localizacion de localhost
            InetAddress direccionServidor = InetAddress.getByName("localhost");
 
            //Creo el socket de UDP
            DatagramSocket socketUDP = new DatagramSocket();
 
            String mensaje = "¡Hola mundo desde el cliente!";
 
            //Convierto el mensaje a bytes
            buffer = mensaje.getBytes();
 
            //Creo un datagrama
            DatagramPacket pregunta = new DatagramPacket(buffer, buffer.length, direccionServidor, PUERTO_SERVIDOR);
 
            //Lo envio con send
            System.out.println("Envio el datagrama");
            socketUDP.send(pregunta);
 
            //Preparo la respuesta
            DatagramPacket peticion = new DatagramPacket(buffer, buffer.length);
 
            //Recibo la respuesta
            socketUDP.receive(peticion);
            System.out.println("Recibo la peticion");
 
            //Cojo los datos y lo muestro
            mensaje = new String(peticion.getData());
            System.out.println(mensaje);
 
            //cierro el socket
            socketUDP.close();
 
        } catch (SocketException ex) {
            Logger.getLogger(Cliente.class.getName()).log(Level.SEVERE, null, ex);
        } catch (UnknownHostException ex) {
            Logger.getLogger(Cliente.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(Cliente.class.getName()).log(Level.SEVERE, null, ex);
        }
 
    }
 
}