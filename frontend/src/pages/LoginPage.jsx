import React, { useEffect } from "react";
import { Container, Row, Col, Image } from "react-bootstrap";
import LoginForm from "../components/auth/LoginForm";
import logo from "./../assets/img/logo-alkarama-web.png";
import StudentImg from "./../assets/img/students.jpg";
import Card from "./../components/UI/cards/Card";
import LoginHeader from "../components/auth/LoginHeader";
import { useSelector } from "react-redux";
import { selectUserType } from "../redux/slices/userTypeSlice";
import { getUserTypeInFrench } from "../utils";
import { ToastContainer } from "react-toastify";
import { useNavigate } from "react-router-dom";
import { checkAuthLoader } from "../utils/loaders";

function LoginPage() {
  const userType = useSelector(selectUserType);
  const navigate = useNavigate();

  useEffect(() => {
    const checkAuth = async () => {
      const path = await checkAuthLoader();
      if (!path) {
        navigate(`/${userType}/dashboard`);
      }
    };
    checkAuth();
  }, [navigate, userType]);

  return (
    <Container className="align-items-center mt-5">
      <ToastContainer />
      <Card>
        <Row className="mb-4">
          <Col lg={4} className="text-center mb-3 mb-lg-0">
            <h1 className="mb-3">Vous êtes ?</h1>
            <h2 className="text-primary mb-3">
              Vous êtes un {getUserTypeInFrench(userType)}
            </h2>
            <Image
              src={StudentImg}
              alt="Students"
              fluid
              className={`d-none d-lg-block rounded mb-3`}
            />
          </Col>
          <Col lg={8} md={12} sm={12} className="text-center">
            <img src={logo} alt="Alkarama Logo" width={200} className="mb-4" />
            <LoginHeader />
            <LoginForm />
          </Col>
        </Row>
      </Card>
    </Container>
  );
}

export default LoginPage;
