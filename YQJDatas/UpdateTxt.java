package me.gacl.websocket;


import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
 
public class UpdateTxt {
	public static void main(String[] args) throws Exception {
		File file = new File("F:\\device.txt");
		
		BufferedReader br = new BufferedReader(new FileReader(file));//读文件
		StringBuffer bf = new StringBuffer();
		String rl = null;//临时的每行数据
		
		while ((rl = br.readLine()) != null) {
			bf.append("'"+rl+"',\r\n");
		}
		System.out.println("ok");
		br.close();
		
		BufferedWriter out = new BufferedWriter(new FileWriter(file));//写入文件
		out.write(bf.toString());//把bf写入文件
		out.flush();//一定要flush才能写入完成
		out.close();//关闭
	}
}