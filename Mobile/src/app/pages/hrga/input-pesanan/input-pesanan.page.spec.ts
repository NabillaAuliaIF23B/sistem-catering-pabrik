import { ComponentFixture, TestBed } from '@angular/core/testing';
import { InputPesananPage } from './input-pesanan.page';

describe('InputPesananPage', () => {
  let component: InputPesananPage;
  let fixture: ComponentFixture<InputPesananPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(InputPesananPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
