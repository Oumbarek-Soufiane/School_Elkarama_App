import React, { useState, useEffect } from "react";
import { Container, Nav, Navbar, Image, Collapse } from "react-bootstrap";
import { Link, NavLink } from "react-router-dom";
import logo from "./../../../assets/img/alkarama-logo.png";
import classes from "./PublicNavbar.module.css";
import Button from "../../UI/buttons/Button";
import { MdConnectWithoutContact } from "react-icons/md";
import { checkAuthLoader, getUserType } from "../../../utils/loaders";

function PublicNavbar() {
  const [expanded, setExpanded] = useState(false);
  const [connected, setConnected] = useState(false);
  const userType = getUserType();
  
  useEffect(() => {
    const checkAuthStatus = async () => {
      try {
        const result = await checkAuthLoader();
        setConnected(result === null);
      } catch (error) {
        console.error("Error checking auth status", error);
        setConnected(false);
      }
    };

    checkAuthStatus();
  }, []);
  const handleNavItemClick = () => {
    setExpanded(false);
  };

  return (
    <Navbar
      expand="lg"
      expanded={expanded}
      onToggle={() => setExpanded(!expanded)}
      className={`${classes.navbar_container} mx-2 mx-lg-5 p-1`}
    >
      <Container fluid>
        <Navbar.Brand
          as={Link}
          to="/"
          className={`${classes.navbar_brand} d-flex align-items-center`}
          onClick={handleNavItemClick}
        >
          <Image
            src={logo}
            alt="school"
            roundedCircle
            style={{ width: "40px", marginRight: "5px" }}
          />
          <h1 className={`${classes.school_name} mt-2`}>Alkarama Boussaid</h1>
        </Navbar.Brand>

        <Navbar.Toggle
          aria-controls="responsive-navbar-nav"
          className={`ms-auto text-light bg-light p-1 px-2 fs-6`}
          onClick={() => setExpanded(!expanded)}
        />
        <Collapse in={expanded}>
          <Navbar.Collapse id="responsive-navbar-nav">
            <Nav className="mx-auto text-center">
              <NavLink
                className={`nav-link ${classes.nav_link}`}
                to="/home"
                onClick={handleNavItemClick}
              >
                Accueil
              </NavLink>
              <NavLink
                className={`nav-link ${classes.nav_link}`}
                to="/about"
                onClick={handleNavItemClick}
              >
                À propos
              </NavLink>
              <NavLink
                className={`nav-link ${classes.nav_link}`}
                to="/programs"
                onClick={handleNavItemClick}
              >
                Programmes
              </NavLink>
              <NavLink
                className={`nav-link ${classes.nav_link}`}
                to="/admissions"
                onClick={handleNavItemClick}
              >
                Admissions
              </NavLink>
              <NavLink
                className={`nav-link ${classes.nav_link}`}
                to="/contact"
                onClick={handleNavItemClick}
              >
                Contact
              </NavLink>
            </Nav>
            <Nav className="text-center">
              {connected ? (
                <NavLink
                  to={`${userType}/dashboard`}
                  className={({ isActive }) =>
                    isActive ? classes.nav_link_active : classes.nav_link
                  }
                  onClick={handleNavItemClick}
                >
                  Tableau de board
                </NavLink>
              ) : (
                <NavLink
                  to="/login"
                  className={({ isActive }) =>
                    isActive ? classes.nav_link_active : classes.nav_link
                  }
                  onClick={handleNavItemClick}
                >
                  Se connecter
                </NavLink>
              )}
              <Link
                to={`#Contact`}
                className={classes.styledButton}
                onClick={handleNavItemClick}
              >
                <Button
                  className={`${classes.button} py-1 px-4 fw-bold w-100`}
                  size="small"
                  text="Contact"
                  backgroundColor="var(--alkarama-secondary-color)"
                  textColor="var(--alkarama-black)"
                  icon={<MdConnectWithoutContact />}
                />
              </Link>
            </Nav>
          </Navbar.Collapse>
        </Collapse>
      </Container>
    </Navbar>
  );
}

export default PublicNavbar;
