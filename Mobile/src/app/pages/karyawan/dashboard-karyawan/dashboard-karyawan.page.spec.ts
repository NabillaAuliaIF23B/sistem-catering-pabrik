import { ComponentFixture, TestBed } from '@angular/core/testing';
import { DashboardKaryawanPage } from './dashboard-karyawan.page';

describe('DashboardKaryawanPage', () => {
  let component: DashboardKaryawanPage;
  let fixture: ComponentFixture<DashboardKaryawanPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(DashboardKaryawanPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
