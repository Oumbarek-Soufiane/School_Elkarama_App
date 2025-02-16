import React, { Fragment } from "react";
import { Link } from "react-router-dom";
import classes from "./PageTitle.module.css";
import { Col, Row } from "react-bootstrap";

function PageTitle({ pageTitle, currentPage }) {
  return (
    <Fragment>
      <Row className={`${classes.page_title} mt-2 align-items-center justify-content-between`}>
        <Col lg={6} md={6} sm={12}>
          <div className="welcome-text">
            <h4>{pageTitle}</h4>
          </div>
        </Col>
        <Col lg={6} md={6} sm={12} className="d-flex justify-content-end">
          <nav>
            <ol className={`${classes.breadcrumb}`}>
              <li className={`${classes.breadcrumb_item}`}>
                <Link to="/" className={classes.nav_link}>
                  Accueil
                </Link>
              </li>
              <li className={`${classes.breadcrumb_item} ${classes.active}`}>
                {currentPage}
              </li>
            </ol>
          </nav>
        </Col>
      </Row>
    </Fragment>
  );
}

export default PageTitle;
