# 1. 새로 배운 내용
- PHP문법
- git pull origin master
- 공백이 오류의 원인이 될 수도 있다는 것


# 2. 문제가 발생하거나 고민한 내용 + 해결과정
- 이번 시간에는 별다른 큰 문제는 없었다.

# 3. 추가한 웹 페이지
- 영상 링크 : https://drive.google.com/file/d/1kzrrkU91j-wFevLt52FTV1F2V7R_YtsW/view?usp=sharing
- 퇴사하지 않은 신입 사원을 소개하는 웹 페이지이다.
-   SELECT e.first_name, e.last_name, e.hire_date, d.dept_name, t.title
    FROM dept_emp de
    INNER JOIN employees e on e.emp_no=de.emp_no
    LEFT JOIN departments d on d.dept_no=de.dept_no
    INNER JOIN salaries s on s.emp_no=e.emp_no
    LEFT JOIN titles t on t.emp_no=e.emp_no
    WHERE s.to_date='9999-01-01'
    ORDER BY e.hire_date DESC LIMIT 10
    ;


# 4. 회고
- +첫 수업 때보다 훨씬 코드와 친해진 듯하다. 여러번 보니 응용도 많이 두렵지 않고 단순히 따라치는 게 아니라 어느정도 알고 치게 되니 오타가 거의 없었다.
- -JOIN과 html에 대해 이전에 배웠는데 거의 까먹었다. 다시 공부해야겠다.
- !공백때문에 오류가 생길 수 있다는 게 새삼 충격적이었다. 오류 해결은 언제나 어려운 것 같다.
