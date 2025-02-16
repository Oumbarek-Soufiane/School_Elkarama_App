import React from "react";
import { BiGridAlt } from "react-icons/bi";
import { MdAdminPanelSettings } from "react-icons/md";
import { PiStudentBold } from "react-icons/pi";
import { RiParentLine } from "react-icons/ri";
import { MdMarkEmailUnread } from "react-icons/md"; 
import { PiChalkboardTeacherBold } from "react-icons/pi";
import { BiRadioCircle } from "react-icons/bi";
import { MdSchool } from "react-icons/md";
import { FaUsers } from "react-icons/fa";
import { FaPeopleGroup } from "react-icons/fa6";
import { GiBookshelf } from "react-icons/gi";
import { SiGoogleclassroom } from "react-icons/si";
import { FaCalendarAlt } from "react-icons/fa";
import { FaUserTimes } from "react-icons/fa";
import { MdAssessment } from "react-icons/md";
import { FaClipboardCheck } from "react-icons/fa";
import { FaBusAlt } from "react-icons/fa";
import { MdDateRange } from "react-icons/md";
import { checkAdminRole } from "../../../utils/loaders";
import { BsBook } from "react-icons/bs";

const adminRole = await checkAdminRole();

export const AdminDatasidebar = [
  {
    title: "Tableau de bord",
    link: "/admin/dashboard",
    icon: <BiGridAlt />,
  },
  {
    ...(adminRole === "super_admin"
      ? {
          title: "Administrateurs",
          icon: <MdAdminPanelSettings />,
          subItems: [
            {
              title: "Liste des administrateurs",
              subIcon: <BiRadioCircle />,
              link: "/admin/admins/list",
            },
            {
              title: "Nouveau administrateur",
              subIcon: <BiRadioCircle />,
              link: "/admin/admins/new",
            },
          ],
        }
      : ""),
  },
  {
    title: "Étudiants",
    icon: <PiStudentBold />,
    subItems: [
      {
        title: "Inscription",
        subIcon: <BiRadioCircle />,
        link: "/admin/student/registration",
      },
      // {
      //   title: "Réinscription",
      //   subIcon: <BiRadioCircle />,
      //   link: "/admin/student/reinscription",
      // *},
      {
        title: "Liste des étudiants",
        subIcon: <BiRadioCircle />,
        link: "/admin/students/list",
      },
    ],
  },
  {
    title: "Parents/Tuteurs",
    icon: <RiParentLine />,
    subItems: [
      {
        title: "Liste des tuteurs",
        subIcon: <BiRadioCircle />,
        link: "/admin/guardians/list",
      },
    ],
  },
  {
    title: "Professeurs",
    icon: <PiChalkboardTeacherBold />,
    subItems: [
      {
        title: "Liste des professeurs",
        subIcon: <BiRadioCircle />,
        link: "/admin/teachers/list",
      },
      {
        title: "Ajouter un professeur",
        subIcon: <BiRadioCircle />,
        link: "/admin/teachers/new",
      },
    ],
  },
  {
    title: "Msssage",
    icon: <MdMarkEmailUnread />,
    subItems: [
      {
        title: "Liste des messages",
        subIcon: <BiRadioCircle />,
        link: "/admin/messages/list",
      },
    ],
  },
  {
    title: "Année scolaire",
    icon: <MdDateRange />,
    subItems: [
      {
        title: "Liste des années",
        subIcon: <BiRadioCircle />,
        link: "/admin/school-years/list",
      },
      {
        title: "Ajouter une année",
        subIcon: <BiRadioCircle />,
        link: "/admin/school-years/new",
      },
    ],
  },
  {
    title: "Niveaux",
    icon: <MdSchool />,
    subItems: [
      {
        title: "Liste des niveaux",
        subIcon: <BiRadioCircle />,
        link: "/admin/levels/list",
      },
      {
        title: "Ajouter un niveau",
        subIcon: <BiRadioCircle />,
        link: "/admin/levels/new",
      },
    ],
  },
  {
    title: "Classes",
    icon: <FaUsers />,
    subItems: [
      {
        title: "Liste des classes",
        subIcon: <BiRadioCircle />,
        link: "/admin/sections/list",
      },
      {
        title: "Ajouter une classe",
        subIcon: <BiRadioCircle />,
        link: "/admin/sections/new",
      },
    ],
  },
  {
    title: "Matières",
    icon: <GiBookshelf />,
    subItems: [
      {
        title: "Liste des matières",
        subIcon: <BiRadioCircle />,
        link: "/admin/subjects/list",
      },
      {
        title: "Ajouter une matière",
        subIcon: <BiRadioCircle />,
        link: "/admin/subjects/new",
      },
      {
        title: "Affecter a la classe",
        subIcon: <BiRadioCircle />,
        link: "/admin/assign/subject/sections",
      },
    ],
  },
  {
    title: "Groupes",
    icon: <FaPeopleGroup />,
    subItems: [
      {
        title: "Liste des groupes",
        subIcon: <BiRadioCircle />,
        link: "/admin/groups/list",
      },
      {
        title: "Ajouter un groupe",
        subIcon: <BiRadioCircle />,
        link: "/admin/groups/new",
      },
      {
        title: "Affecter au groupe",
        subIcon: <BiRadioCircle />,
        link: "/admin/assign/students/groups",
      },
    ],
  },
  {
    title: "Salles",
    icon: <SiGoogleclassroom />,
    subItems: [
      {
        title: "Liste des salles",
        subIcon: <BiRadioCircle />,
        link: "/admin/class-rooms/list",
      },
      {
        title: "Ajouter une salle",
        subIcon: <BiRadioCircle />,
        link: "/admin/class-rooms/new",
      },
    ],
  },
  {
    title: "Emploi du temps",
    icon: <FaCalendarAlt />,
    subItems: [
      {
        title: "Gérer l'emploi du temps",
        subIcon: <BiRadioCircle />,
        link: "/admin/schedule/manage",
      },
    ],
  },
  {
    title: "Absences",
    icon: <FaUserTimes />,
    subItems: [
      {
        title: "Absences des étudiants",
        subIcon: <BiRadioCircle />,
        link: "/admin/absences/students",
      },
      {
        title: "Absences des professeurs",
        subIcon: <BiRadioCircle />,
        link: "/admin/absences/teachers",
      },
    ],
  },
  {
    title: "Notes",
    icon: <MdAssessment />,
    subItems: [
      {
        title: "Liste des notes",
        subIcon: <BiRadioCircle />,
        link: "/admin/grades/all",
      },
    ],
  },
  {
    title: "Évaluations",
    icon: <FaClipboardCheck />,
    subItems: [
      {
        title: "Liste des évaluations",
        subIcon: <BiRadioCircle />,
        link: "/admin/evaluations/list",
      },
      {
        title: "Ajouter une évaluations",
        subIcon: <BiRadioCircle />,
        link: "/admin/evaluations/new",
      },
    ],
  },
  {
    title: "Transport scolaire",
    icon: <FaBusAlt />,
    subItems: [
      {
        title: "Liste des bus",
        subIcon: <BiRadioCircle />,
        link: "/admin/buses/list",
      },
      {
        title: "Ajouter un bus",
        subIcon: <BiRadioCircle />,
        link: "/admin/buses/new",
      },
      {
        title: "Liste du personnel",
        subIcon: <BiRadioCircle />,
        link: "/admin/transport-staff/list",
      },
      {
        title: "Ajouter personnel",
        subIcon: <BiRadioCircle />,
        link: "/admin/transport-staff/new",
      },
      {
        title: "Liste des étudiants",
        subIcon: <BiRadioCircle />,
        link: "/admin/students/need/transportation",
      },
    ],
  },
].map((item, index) => ({ ...item, id: index + 1 }));

export const TeacherDatasidebar = [
  {
    title: "Tableau de bord",
    link: "/teacher/dashboard",
    icon: <BiGridAlt />,
  },
  {
    title: "Mes Groupes",
    icon: <FaPeopleGroup />,
    subItems: [
      {
        title: "Liste des groups",
        subIcon: <BiRadioCircle />,
        link: "/teacher/groups/list",
      },
    ],
  },
  {
    title: "Notes",
    icon: <MdAssessment />,
    subItems: [
      {
        title: "affecter les notes",
        subIcon: <BiRadioCircle />,
        link: "/teacher/assign/marks/students",
      },
    ],
  },
  {
    title: "appel/absence",
    icon: <FaUserTimes />,
    subItems: [
      {
        title: "Faire l'appel",
        subIcon: <BiRadioCircle />,
        link: "/teacher/students/roll-call-absence",
      },
    ],
  },
  {
    title: "cours",
    icon: <BsBook />,
    subItems: [
      {
        title: "Nouveau Cours",
        subIcon: <BiRadioCircle />,
        link: "/teacher/courses/new",
      },
      {
        title: "Liste des cours",
        subIcon: <BiRadioCircle />,
        link: "/teacher/courses/list",
      },
    ],
  },
].map((item, index) => ({ ...item, id: index + 1 }));

export const StudentDatasidebar = [
  {
    title: "Tableau de bord",
    link: "/student/dashboard",
    icon: <BiGridAlt />,
  },
  {
    title: "Emploi du temps",
    icon: <FaCalendarAlt />,
    subItems: [
      {
        title: "Mon emploi du temps",
        subIcon: <BiRadioCircle />,
        link: "/student/schedule",
      },
    ],
  },
  {
    title: "Absences",
    icon: <FaUserTimes />,
    subItems: [
      {
        title: "Mes absences",
        subIcon: <BiRadioCircle />,
        link: "/student/absences",
      },
    ],
  },
  {
    title: "Cours",
    icon: <BsBook />,
    subItems: [
      {
        title: "Mes Cours",
        subIcon: <BiRadioCircle />,
        link: "/student/courses",
      },
    ],
  },
  {
    title: "Notes",
    icon: <MdAssessment />,
    subItems: [
      {
        title: "Liste des notes",
        subIcon: <BiRadioCircle />,
        link: "/student/marks",
      },
    ],
  },
].map((item, index) => ({ ...item, id: index + 1 }));

export const GuardianDatasidebar = [
  {
    title: "Tableau de bord",
    link: "/guardian/dashboard",
    icon: <BiGridAlt />,
  },
].map((item, index) => ({ ...item, id: index + 1 }));
