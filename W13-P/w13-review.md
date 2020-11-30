# 1. 새로 배운 내용
- tomcat 사용(포트 변경 : conf>포트값 변경)
- 이클립스, 톰캣, 오라클 연동
- JSP의 개념과 기본적인 코드
- jsp파일은 대문자로 시작하도록 만드는 것이 좋다.

# 2. 문제가 발생하거나 고민한 내용 + 해결과정
- 프로젝트에서 사용하는 java버전이 사용하고있는 java컴파일러의 버전과 다르다는 오류가 나와 프로젝트 우클릭>properties>Project facets 에서 자바의 버전을 낮추었다.
- 이클립스의 ui가 표시되지 않는 오류가 발생하여 이전 버전(2018년도)의 이클립스를 다운로드받았더니 잘 실행이 되었다.
- ojdbc를 연결하면서 connection test가 제대로 되지 않아 보니 포트 번호와 호스트명이 달라 수정하였다.(1521->1522 / server->localhost)

# 3. 참고한 사이트
- https://velog.io/@yseonjin/JSP-SQL-%ED%95%99%EC%83%9D%EC%84%B1%EC%A0%81%EA%B4%80%EB%A6%AC-%ED%8E%98%EC%9D%B4%EC%A7%80%EB%A7%8C%EB%93%A4%EA%B8%B0-qg551d69

# 3. 회고
- 영상 링크 : https://drive.google.com/file/d/1xxtDErzR-308-Cz0k7Uer8JCpJ0hKq59/view?usp=sharing
- +JSP라는 새로운 언어를 접했고 처음으로 이클립스와 java를 이용하여 웹 페이지를 만들었다. 
- -따라할 줄만 알지 내가 직접 코드를 쓸 수가 없다. 매일 적는 말이라 새삼스럽지만 열심히 공부해야 겠다...
- !php로 구현하던 기능을 java와 jsp로 똑같이 구현하는 과정이 흥미로웠다.
