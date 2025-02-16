import React from "react";
import Card from "./../components/UI/cards/Card";
import { Container, Row, Col } from "react-bootstrap";
import {
  FaChalkboardTeacher,
  FaUserShield,
  FaBusAlt,
  FaBuilding,
} from "react-icons/fa";
import { PiStudentBold } from "react-icons/pi";
import { MdClass } from "react-icons/md";
import classes from "./AdminDashboardPage.module.css";
import { useLoaderData } from "react-router-dom";
function AdminDashboardPage() {
  const data = useLoaderData();

  return (
    <Container fluid>
      <Row>
        <Col lg={4} md={6} sm={12}>
          <Card>
            <div className="d-flex justify-content-between align-items-center">
              <div className={classes.iconBg}>
                <MdClass className={classes.icon} />
              </div>
              <div>
                <p>Groupes</p>
                <p>{data.groupsCount}</p>
              </div>
            </div>
          </Card>
        </Col>

        <Col lg={4} md={6} sm={12}>
          <Card>
            <div className="d-flex justify-content-between align-items-center">
              <div className={classes.iconBg}>
                <PiStudentBold className={classes.icon} />
              </div>
              <div>
                <p>Élèves</p>
                <p>{data.studentsCount}</p>
              </div>
            </div>
          </Card>
        </Col>

        <Col lg={4} md={6} sm={12}>
          <Card>
            <div className="d-flex justify-content-between align-items-center">
              <div className={classes.iconBg}>
                <FaUserShield className={classes.icon} />
              </div>
              <div>
                <p>Admins</p>
                <p>{data.adminsCount}</p>
              </div>
            </div>
          </Card>
        </Col>

        <Col lg={4} md={6} sm={12}>
          <Card>
            <div className="d-flex justify-content-between align-items-center">
              <div className={classes.iconBg}>
                <FaChalkboardTeacher className={classes.icon} />
              </div>
              <div>
                <p>Professeurs</p>
                <p>{data.teachersCount}</p>
              </div>
            </div>
          </Card>
        </Col>

        <Col lg={4} md={6} sm={12}>
          <Card>
            <div className="d-flex justify-content-between align-items-center">
              <div className={classes.iconBg}>
                <FaBuilding className={classes.icon} />
              </div>
              <div>
                <p>Salles</p>
                <p>{data.classRoomsCount}</p>
              </div>
            </div>
          </Card>
        </Col>

        <Col lg={4} md={6} sm={12}>
          <Card>
            <div className="d-flex justify-content-between align-items-center">
              <div className={classes.iconBg}>
                <FaBusAlt className={classes.icon} />
              </div>
              <div>
                <p>Bus</p>
                <p>{data.busesCount}</p>
              </div>
            </div>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default AdminDashboardPage;
