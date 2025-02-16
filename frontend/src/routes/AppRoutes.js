import React from "react";
import {
  Navigate,
  RouterProvider,
  createBrowserRouter,
} from "react-router-dom";
import DashboardLayout from "../layouts/DashboardLayout";
import HomePage from "../pages/HomePage";
import AdminDashboardPage from "../pages/AdminDashboardPage";
import PublicLayout from "../layouts/PublicLayout";
import LoginPage from "../pages/LoginPage";
import ErrorPage from "../pages/ErrorPage";
import {
  authAction,
  schoolYearAction,
  levelAction,
  subjectAction,
  classRoomAction,
  sectionAction,
  groupAction,
  busAction,
  transportStaffAction,
  teacherAction,
  assignToGroupAction,
  evaluationAction,
  updateGuardianAction,
  assignSubjectToSection,
  assignTeachersToGroupAction,
  registerAdminAction,
  assignMarksToStudentsAction,
  assignStudentsAbsencesAction,
  courseAction,
  updateStudentAction,
} from "../utils/actions";

import {
  checkAuthLoader,
  levelLoader,
  levelsLoader,
  schoolYearLoader,
  schoolYearsLoader,
  subjectLoader,
  subjectsLoader,
  classRoomLoader,
  classRoomsLoader,
  sectionLoader,
  sectionsLoader,
  groupLoader,
  groupsLoader,
  studentLoader,
  studentsLoader,
  busLoader,
  busesLoader,
  transportStaffLoader,
  transportsStaffLoader,
  studentsTransportationLoader,
  teacherLoader,
  teachersLoader,
  evaluationLoader,
  updateEvaluationLoader,
  evaluationsLoader,
  guardianLoader,
  guardiansLoader,
  assignSubjectsLoader,
  adminLoader,
  adminsLoader,
  teacherGoupsAndSubjectsLoader,
  courseLoader,
  coursesLoader,
  courseStudentLoader,
  groupDetailsLoader,
  updateStudentLoader,
  marksLoader,
  contactLoader,
  studentAttendanceLoader,
  adminDashboardLoader
} from "../utils/loaders";

import CreateSchoolYearPage from "../pages/school-year/CreateSchoolYearPage";
import UpdateSchoolYearPage from "./../pages/school-year/UpdateSchoolYearPage";
import SchoolYearListPage from "../pages/school-year/SchoolYearListPage";
import CreateLevelPage from "./../pages/level/CreateLevelPage";
import UpdateLevelPage from "./../pages/level/UpdateLevelPage";
import LevelListPage from "../pages/level/LevelListPage";
import CreateSubjectPage from "../pages/subject/CreateSubjectPage";
import UpdateSubjectPage from "../pages/subject/UpdateSubjectPage";
import SubjectListPage from "../pages/subject/SubjectListPage";
import CreateClassRoomPage from "../pages/class-room/CreateClassRoomPage";
import ClassRoomListPage from "../pages/class-room/ClassRoomListPage";
import UpdateClassRoomPage from "../pages/class-room/UpdateClassRoomPage";
import CreateSectionPage from "../pages/section/CreateSectionPage";
import SectionListPage from "../pages/section/SectionListPage";
import UpdateSectionPage from "../pages/section/UpdateSectionPage";
import CreateGroupPage from "../pages/group/CreateGroupPage";
import GroupListPage from "../pages/group/GroupListPage";
import UpdateGroupPage from "../pages/group/UpdateGroupPage";
import StudentRegistrationPage from "./../pages/student/StudentRegistrationPage";
import StudentListPage from "../pages/student/StudentListPage";
import StudentDetailsPage from "../pages/student/StudentDetailsPage";
import CreatBusPage from "../pages/transport/bus/CreateBusPage";
import BusListPage from "../pages/transport/bus/BusListPage";
import UpdateBusPage from "../pages/transport/bus/UpdateBusPage";
import CreateTransportStaffPage from "../pages/transport/staff/CreateTransportStaffPage";
import TransportStaffListPage from "../pages/transport/staff/TransportStaffListPage";
import UpdateTransportStaffPage from "../pages/transport/staff/UpdateTransportStaffPage";
import CreateTeacherPage from "../pages/teacher/CreateTeacherPage";
import UpdateTeacherPage from "../pages/teacher/UpdateTeacherPage";
import TeacherListPage from "../pages/teacher/TeacherListPage";
import AssignStudentToGroupPage from "../pages/group/AssignStudentToGroupPage";
import EvaluationListPage from "../pages/evaluation/EvaluationListPage";
import CreateEvaluationPage from "../pages/evaluation/CreateEvaluationPage";
import UpdateEvaluationPage from "../pages/evaluation/UpdateEvaluationPage";
import GuardianListPage from "../pages/guardian/GuardianListPage";
import UpdateGuardianPage from "../pages/guardian/UpdateGuardianPage";
import AssignSubjectToSectionPage from "../pages/subject/AssignSubjectToSectionPage";
import TeacherDashboardPage from "../pages/TeacherDashboardPage";
import StudentDashboardPage from "../pages/StudentDashboardPage";
import GuardianDashboardPage from "../pages/GuardianDashboardPage";
import AssignTeacherToGroupPage from "../pages/group/AssignTeacherToGroupPage";
import CreateAdminPage from "../pages/admin/CreateAdminPage";
import AdminListPage from "../pages/admin/AdminListPage";
import UpdateAdminPage from "../pages/admin/UpdateAdminPage";
import AssignMarkToStudentPage from "../pages/mark/AssignMarkToStudentPage";
import StudentAbsencePage from "../pages/absences/StudentAbsencePage";
import TeacherGroupsPage from "../pages/teacher/TeacherGroupsPage";
import CreateCoursePage from "../pages/course/CreateCourse";
import TeacherCoursesListPage from "../pages/course/TeacherCoursesListPage";
import UpdateCoursePage from "../pages/course/UpdateCourse";
import GroupDetailsPage from "../pages/group/GoupDetailsPage";
import UpdateStudentPage from "../pages/student/UpdateStudentPage";
import StudentMarks from "../pages/student/StudentMarks";
import MessageListPage from "../pages/contact/MessageListPage";
import StudentAttendance from "../pages/absences/StudentAttendances";
import StudentAttendances from "../pages/absences/StudentAttendances";
import StudentCoursesPage from "../pages/course/StudentCoursesPage";

const router = createBrowserRouter([
  {
    path: "/",
    element: <PublicLayout />,
    errorElement: <ErrorPage />,
    children: [
      { index: true, element: <HomePage /> },
      {
        path: "login",
        element: <LoginPage />,
        action: authAction,
      },
    ],
  },
  {
    path: "/admin",
    errorElement: <ErrorPage />,
    element: <DashboardLayout />,
    loader: checkAuthLoader,
    children: [
      { index: true, element: <Navigate to="dashboard" /> },
      { path: "dashboard", element: <AdminDashboardPage />,loader: adminDashboardLoader, },
      // school-years
      {
        path: "school-years/list",
        element: <SchoolYearListPage />,
        loader: schoolYearsLoader,
      },
      {
        path: "school-years/new",
        element: <CreateSchoolYearPage />,
        action: schoolYearAction,
      },
      {
        path: "school-years/:id/edit",
        element: <UpdateSchoolYearPage />,
        loader: schoolYearLoader,
        action: schoolYearAction,
      },
      // levels
      {
        path: "levels/list",
        element: <LevelListPage />,
        loader: levelsLoader,
      },
      {
        path: "levels/new",
        element: <CreateLevelPage />,
        action: levelAction,
      },
      {
        path: "levels/:id/edit",
        element: <UpdateLevelPage />,
        loader: levelLoader,
        action: levelAction,
      },
      // subjects
      {
        path: "subjects/list",
        element: <SubjectListPage />,
        loader: subjectsLoader,
      },
      {
        path: "subjects/new",
        element: <CreateSubjectPage />,
        action: subjectAction,
      },
      {
        path: "subjects/:id/edit",
        element: <UpdateSubjectPage />,
        loader: subjectLoader,
        action: subjectAction,
      },
      // section subject
      {
        path: "assign/subject/sections",
        element: <AssignSubjectToSectionPage />,
        loader: assignSubjectsLoader,
        action: assignSubjectToSection,
      },
      // Classs rooms
      {
        path: "class-rooms/list",
        element: <ClassRoomListPage />,
        loader: classRoomsLoader,
      },
      {
        path: "class-rooms/new",
        element: <CreateClassRoomPage />,
        action: classRoomAction,
      },
      {
        path: "class-rooms/:id/edit",
        element: <UpdateClassRoomPage />,
        loader: classRoomLoader,
        action: classRoomAction,
      },
      // sections
      {
        path: "sections/list",
        element: <SectionListPage />,
        loader: sectionsLoader,
      },
      {
        path: "sections/new",
        element: <CreateSectionPage />,
        loader: levelsLoader,
        action: sectionAction,
      },
      {
        path: "sections/:id/edit",
        element: <UpdateSectionPage />,
        loader: sectionLoader,
        action: sectionAction,
      },
      // groups
      {
        path: "groups/list",
        element: <GroupListPage />,
        loader: groupsLoader,
      },
      {
        path: "groups/new",
        element: <CreateGroupPage />,
        loader: sectionsLoader,
        action: groupAction,
      },
      {
        path: "groups/:id/edit",
        element: <UpdateGroupPage />,
        loader: groupLoader,
        action: groupAction,
      },
      {
        path: "assign/students/groups",
        element: <AssignStudentToGroupPage />,
        loader: groupsLoader,
        action: assignToGroupAction,
      },
      {
        path: "assign/teachers/groups",
        element: <AssignTeacherToGroupPage />,
        loader: groupsLoader,
        action: assignTeachersToGroupAction,
      },
      // Registration
      {
        path: "student/registration",
        element: <StudentRegistrationPage />,
      },
      // Student List
      {
        path: "students/list",
        element: <StudentListPage />,
        loader: studentsLoader,
      },
      // Student details
      {
        path: "students/:id/details",
        element: <StudentDetailsPage />,
        loader: studentLoader,
      },
      {
        path: "students/:id/edit",
        element: <UpdateStudentPage />,
        loader: updateStudentLoader,
        action: updateStudentAction,
      },
      // Transport
      // Bus
      {
        path: "buses/list",
        element: <BusListPage />,
        loader: busesLoader,
      },
      {
        path: "buses/new",
        element: <CreatBusPage />,
        action: busAction,
      },
      {
        path: "buses/:id/edit",
        element: <UpdateBusPage />,
        loader: busLoader,
        action: busAction,
      },
      // staff
      {
        path: "transport-staff/list",
        element: <TransportStaffListPage />,
        loader: transportsStaffLoader,
      },
      {
        path: "transport-staff/new",
        element: <CreateTransportStaffPage />,
        loader: busesLoader,
        action: transportStaffAction,
      },
      {
        path: "transport-staff/:id/edit",
        element: <UpdateTransportStaffPage />,
        loader: transportStaffLoader,
        action: transportStaffAction,
      },
      // students transportation
      {
        path: "students/need/transportation",
        element: <StudentListPage />,
        loader: studentsTransportationLoader,
      },
      // Teacher
      {
        path: "teachers/list",
        element: <TeacherListPage />,
        loader: teachersLoader,
      },
      {
        path: "teachers/new",
        element: <CreateTeacherPage />,
        loader: subjectsLoader,
        action: teacherAction,
      },
      {
        path: "teachers/:id/edit",
        element: <UpdateTeacherPage />,
        loader: teacherLoader,
        action: teacherAction,
      },
      // Evaluation
      {
        path: "evaluations/list",
        element: <EvaluationListPage />,
        loader: evaluationsLoader,
      },
      {
        path: "evaluations/new",
        element: <CreateEvaluationPage />,
        loader: evaluationLoader,
        action: evaluationAction,
      },
      {
        path: "evaluations/:id/edit",
        element: <UpdateEvaluationPage />,
        loader: updateEvaluationLoader,
        action: evaluationAction,
      },
      // Guardian
      {
        path: "guardians/list",
        element: <GuardianListPage />,
        loader: guardiansLoader,
      },
      {
        path: "guardians/:id/edit",
        element: <UpdateGuardianPage />,
        loader: guardianLoader,
        action: updateGuardianAction,
      },
      // Admin
      {
        path: "admins/list",
        element: <AdminListPage />,
        loader: adminsLoader,
      },
      {
        path: "admins/new",
        element: <CreateAdminPage />,
        action: registerAdminAction,
      },
      {
        path: "admins/:id/edit",
        element: <UpdateAdminPage />,
        loader: adminLoader,
        action: registerAdminAction,
      },
      {
        path: "messages/list",
        element: <MessageListPage />,
        loader: contactLoader,
      },
    ],
  },
  {
    path: "/teacher",
    errorElement: <ErrorPage />,
    element: <DashboardLayout />,
    loader: checkAuthLoader,
    children: [
      { index: true, element: <Navigate to="dashboard" /> },
      { path: "dashboard", element: <TeacherDashboardPage /> },
      {
        path: "courses/new",
        element: <CreateCoursePage />,
        loader: teacherGoupsAndSubjectsLoader,
        action: courseAction,
      },
      {
        path: "courses/list",
        element: <TeacherCoursesListPage />,
        loader: coursesLoader,
      },
      {
        path: "courses/:id/edit",
        element: <UpdateCoursePage />,
        loader: courseLoader,
        action: courseAction,
      },
      {
        path: "groups/list",
        element: <TeacherGroupsPage />,
        loader: teacherGoupsAndSubjectsLoader,
      },
      {
        path: "groups/:id",
        element: <GroupDetailsPage />,
        loader: groupDetailsLoader,
      },
      {
        path: "assign/marks/students",
        element: <AssignMarkToStudentPage />,
        loader: teacherGoupsAndSubjectsLoader,
        action: assignMarksToStudentsAction,
      },
      {
        path: "students/roll-call-absence",
        element: <StudentAbsencePage />,
        loader: teacherGoupsAndSubjectsLoader,
        action: assignStudentsAbsencesAction,
      },
    ],
  },
  {
    path: "/student",
    errorElement: <ErrorPage />,
    element: <DashboardLayout />,
    loader: checkAuthLoader,
    children: [
      { index: true, element: <Navigate to="dashboard" /> },
      { path: "dashboard", element: <StudentDashboardPage /> },
      {
        path: "schedule",
        // element: <CreateAdminPage />,
        // action: registerAdminAction,
      },
      {
        path: "marks",
        element: <StudentMarks />,
        loader: marksLoader,
      },
      {
        path: "courses",
        element: <StudentCoursesPage />,
        loader: courseStudentLoader,
      },
      {
        path: "absences",
        element: <StudentAttendances />,
        loader: studentAttendanceLoader,
      },
    ],
  },
  {
    path: "/guardian",
    errorElement: <ErrorPage />,
    element: <DashboardLayout />,
    loader: checkAuthLoader,
    children: [
      { index: true, element: <Navigate to="dashboard" /> },
      { path: "dashboard", element: <GuardianDashboardPage /> },
    ],
  },
]);

function AppRoutes() {
  return <RouterProvider router={router} />;
}

export default AppRoutes;
