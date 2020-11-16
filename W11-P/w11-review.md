#1. 새로 배운 내용
	-트랜잭션(rollback&commit / 원자성, 일관성, 독립성, 지속성)
	-커밋한 뒤 오류를 발견하게 되면 오라클DB에서 제공하는 백업 기능 사용
	-jdbc sql쿼리 전송 인터페이스
		+PreparedStatement를 가장 많이 사용
		+PreparedStatement pstm = conn.prepareStatement(“select * from T where a = ?”);//? : 위치 홀더
		 pstm.setString(1, "위치홀더의 값");
		 ResultSet rs = pstm.executeQuery();
		+statement는 프로그램 실행시마다 서버에서 분석하지만 preparedstatement는 재사용 가능
		+preparedstatement는 미리 컴파일되어 실행 속도가 빠름
		+preparedstatement는 동적 쿼리 처리 가능
		+"", ''로 보안 처리 가능
		+반드시 예외처리(try catch, throws)
	-연결 해제를 함수에서 하면 함수마다 다시 DB에 연결해야 한다.
	-리팩토링(함수 실행시마다 db를 연결하고 종료해서 자원 반납)
#2. 문제가 발생하거나 고민한 내용
	-과제 도중 실수로 타입이 맞지 않는 잘못된 데이터를 추가하였는데 삭제하기 위해 Test.delete()를 사용했으나 데이터에 접근이 되지 않았고 sqldeveloper에서도 뜨지 않았다. 컴퓨터를 재부팅하니 접근이 되어 삭제할 수 있었다.
#3. 회고
	-실행 영상 : https://drive.google.com/file/d/1LUbN0GvD6SzFQc4125RKXKWlKhNkwKdW/view?usp=sharing
	-+자바와 트랜잭션의 개념을 복습할 수 있었다.
	--코드가 아직 익숙하지 않은 부분도 있었고 자바를 너무 오랜만에 접해 어려웠다. 이제 졸업도 다가오는데 부족한 점이 너무 많아 반성이 된다. 
	-!더 공부해야겠다. 