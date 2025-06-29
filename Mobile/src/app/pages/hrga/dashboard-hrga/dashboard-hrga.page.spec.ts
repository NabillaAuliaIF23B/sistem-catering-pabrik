import { ComponentFixture, TestBed } from '@angular/core/testing';
import { DashboardHrgaPage } from './dashboard-hrga.page';

describe('DashboardHrgaPage', () => {
  let component: DashboardHrgaPage;
  let fixture: ComponentFixture<DashboardHrgaPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(DashboardHrgaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
