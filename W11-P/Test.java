package DB;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.PreparedStatement;

public class Test {	
	private static String className = "oracle.jdbc.driver.OracleDriver";
	private static String url = "jdbc:oracle:thin:@localhost:1522:xe";
	private static String user = "hr";
	private static String password = "1234";
	
	public Connection getConnection() {
		Connection conn = null;
		
		try {
			Class.forName(className);
			conn = DriverManager.getConnection(url, user, password);			
			System.out.println("connection success");
		} catch (ClassNotFoundException | SQLException e) {
			System.out.println("connection fail");
			e.printStackTrace();
		}
		
		return conn;
	}
	
	public void closeAll(Connection conn, PreparedStatement pstm, ResultSet rs) {
		try {
			if (rs != null) rs.close();
			if (pstm != null) pstm.close();
			if (conn != null) conn.close();
			System.out.println("connection closed");
		} catch (SQLException sqle) {
			System.out.println("error");
			sqle.printStackTrace();
		}
	}
	
	private void select() {
		Connection conn = null;
		PreparedStatement pstm = null;
		ResultSet rs = null;
		String sql = "select c.country_id, c.country_name, r.region_name from countries c join regions r on c.region_id = r.region_id order by rownum desc";
		
		try {
			conn = this.getConnection();
			pstm = conn.prepareStatement(sql);
			rs = pstm.executeQuery(sql);	
			int count = 0;
			while(rs.next()) {
				System.out.print("country_id: " + rs.getString("country_id"));
				System.out.print("\tcountry_name: " + rs.getString("country_name"));
				System.out.println("\tregion_name: " + rs.getString("region_name"));
				count = count + 1;
			}			
			System.out.println(count + " row selected");									
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, pstm, rs);			
		}
	}
	
	private void update() {
		Connection conn = null;
		PreparedStatement pstm = null;		
		String sql = "update countries set region_id = 3 where country_id = 'KR'";
		
		try {
			conn = this.getConnection();
			pstm = conn.prepareStatement(sql);
			int count = pstm.executeUpdate(sql);
			System.out.println(count + " row updated");			
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, pstm, null);			
		}
	}
	
	private void insert() {
		Connection conn = null;
		PreparedStatement pstm = null;		
		String sql = "insert into countries values ('KR', 'Korea', 2)";
		
		try {
			conn = this.getConnection();
			pstm = conn.prepareStatement(sql);
			int count = pstm.executeUpdate(sql);
			System.out.println(count + " row inserted");			
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, pstm, null);			
		}
	}
	
	private void delete() {
		Connection conn = null;
		PreparedStatement pstm = null;		
		String sql = "delete from countries where country_name = 'Korea'";
		
		try {
			conn = this.getConnection();
			pstm = conn.prepareStatement(sql);
			int count = pstm.executeUpdate(sql);
			System.out.println(count + " row deleted");			
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			this.closeAll(conn, pstm, null);			
		}
	}	
	
	public static void main(String[] args) {
		Test so = new Test();
		so.select();
		so.insert();
		so.select();
		so.update();
		so.select();
		so.delete();
		so.select();
	}
}
