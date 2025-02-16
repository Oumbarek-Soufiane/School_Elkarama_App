import React from "react";
import { PiListDashesLight } from "react-icons/pi";
import { Link } from "react-router-dom";
import { Dropdown, Nav } from "react-bootstrap";
import Logo from "./../../../assets/img/alkarama-logo.png";
import classes from "./Header.module.css";
import { useDispatch, useSelector } from "react-redux";
import { toggleSidebar } from "../../../redux/slices/sidebarSlice";
import { logout } from "../../../utils/actions";
import { selectUserType } from "../../../redux/slices/userTypeSlice";
import { getUserTypeInFrench } from "./../../../utils/index";

function Header() {
  const dispatch = useDispatch();
  const userType = useSelector(selectUserType);

  const onToggleSidebar = () => {
    dispatch(toggleSidebar());
  };

  const handleSignOut = () => {
    logout();
  };

  return (
    <div>
      <header
        id="header"
        className={`${classes.header} fixed-top d-flex align-items-center`}
      >
        <div
          className={`${classes.logo_title} d-flex align-items-center justify-content-between`}
        >
          <Link
            to="/"
            className={`${classes.logo} d-flex align-items-center text-decoration-none`}
          >
            <img src={Logo} alt="school-logo" />
            <span className="d-none d-lg-block ">Alkarama Boussaid</span>
          </Link>
          <PiListDashesLight
            onClick={onToggleSidebar}
            className={classes.toggle_sidebar_btn}
          />
        </div>
        <nav className={`${classes.header_nav} ms-auto`}>
          <ul className="d-flex align-items-center">
            <li className="nav-item dropdown pe-3">
              <Dropdown>
                <Dropdown.Toggle
                  as={Nav.Link}
                  className={`nav-link ${classes.nav_profile} d-flex align-items-center pe-0`}
                  id="dropdown-basic"
                >
                  <img
                    src="https://th.bing.com/th/id/R.379574c7eb04a24fd3c5a8a221ddfa3e?rik=pkIk4M9ydIkGHA&pid=ImgRaw&r=0"
                    alt="Profile"
                    className="rounded-circle"
                  />
                  <span className="d-none d-md-block ps-2">T - Oussama</span>
                </Dropdown.Toggle>
                <Dropdown.Menu className="dropdown-menu-end dropdown-menu-arrow profile">
                  <Dropdown.Header className="text-center">
                    <h6>Taghlaoui Oussama</h6>
                    <span>{getUserTypeInFrench(userType)}</span>
                  </Dropdown.Header>
                  <Dropdown.Item as="div">
                    <Link
                      className="dropdown-item d-flex align-items-center"
                      to="users-profile"
                    >
                      <span>Mon profile</span>
                    </Link>
                  </Dropdown.Item>
                  <Dropdown.Item as="div" onClick={handleSignOut}>
                    <Link
                      className="dropdown-item d-flex align-items-center"
                      to="/login"
                    >
                      <span>Se déconnecter</span>
                    </Link>
                  </Dropdown.Item>
                </Dropdown.Menu>
              </Dropdown>
            </li>
          </ul>
        </nav>
      </header>
    </div>
  );
}

export default Header;
